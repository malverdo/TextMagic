<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entities\Test\Answer;
use App\Domain\Entities\Test\TestResult;
use App\Infrastructure\Repository\QuestionRepository;
use App\Infrastructure\Repository\TestResultRepository;
use App\Presentation\Dto\RequestResultTestDto;
use Exception;

class TestHandler
{
    public function __construct(
        private readonly QuestionRepository $questions,
        private readonly TestResultRepository $testResults,
    ) {
    }

    /**
     * @throws Exception
     */
    public function handler(RequestResultTestDto $dto): void
    {
        $testId = $dto->testId;
        $testResultId = $dto->testResultId;
        $answersDetails = [];
        $result = [];
        $questions = $this->questions->getQuestions($testId);

        foreach ($dto->questions as $questionDto) {
            $question = $questions->filter(fn ($q) => $q->getId() === $questionDto->id)->first();

            if (false === $question) {
                continue;
            }

            $answerIds = $questionDto->answerIds;
            $answers = $question->getAnswers()->filter(fn ($a) => in_array($a->getId(), $answerIds));
            $resultQuestion = true;


            /**
             * @var Answer $answer
             */
            foreach ($answers as $answer) {
                $answersDetails[] = [
                    'title' => $answer->getTitle()->getValue(),
                    'answerId' => $answer->getId()
                ];

                if (!$answer->getIsCorrect()) {
                    $resultQuestion = false;
                }

            }

            $result[$resultQuestion ? 'success' : 'failed'][] = [
                'isCorrect' => $resultQuestion,
                'titleQuestion' => $question->getTitle()->getValue(),
                'questionId' => $question->getId(),
                'answers' => $answersDetails,
            ];
            $answersDetails = [];
        }

        $testResult = new TestResult($testResultId, $testId, $result);
        $this->testResults->save($testResult);
    }
}
