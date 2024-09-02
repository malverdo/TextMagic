<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Test\Entity\Question;
use App\Domain\Test\Entity\TestResult;
use App\Infrastructure\Repository\QuestionRepository;
use App\Infrastructure\Repository\TestResultRepository;
use App\Presentation\Dto\RequestResultTestDto;
use Doctrine\Common\Collections\ArrayCollection;

class TestHandler
{
    public function __construct(
        private readonly QuestionRepository $questions,
        private readonly TestResultRepository $testResults,
    ) {
    }

    public function handle(RequestResultTestDto $dto): int
    {
        $testId = $dto->testId;
        $result = [];
        $questions = $this->questions->getQuestions($testId);

        foreach ($dto->questions as $questionDto) {
            $answerIds = $questionDto->answerIds;
            $question = $questions->filter(fn ($q) => $q->getId() === $questionDto->id)->first();

            if (false === $question) {
                continue;
            }

            $answers = $question->getAnswers()->filter(fn ($a) => in_array($a->getId(), $answerIds));
            $resultQuestion = $this->isAnswer($answers);

            $result[$resultQuestion ? 'success' : 'failed'][] = $this->formatQuestionResult(
                $resultQuestion,
                $question,
                $answers
            );
        }

        $testResult = new TestResult($testId, $result);
        $this->testResults->save($testResult);

        return $testResult->getId();
    }

    /**
     * Форматирует результат для одного вопроса.
     */
    private function formatQuestionResult(bool $isCorrect, Question $question, ArrayCollection $answers): array
    {
        return [
            'isCorrect' => $isCorrect,
            'titleQuestion' => $question->getTitle()->getValue(),
            'questionId' => $question->getId(),
            'answers' => array_values($answers->map(fn ($a) => [
                'title' => $a->getTitle()->getValue(),
                'answerId' => $a->getId(),
            ])->toArray()),
        ];
    }

    private function isAnswer(ArrayCollection $answers): bool
    {
        $resultQuestion = true;

        foreach ($answers as $answer) {
            if (!$answer->getIsCorrect()) {
                $resultQuestion = false;
            }
        }

        return $resultQuestion;
    }
}
