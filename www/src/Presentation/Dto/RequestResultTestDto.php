<?php

declare(strict_types=1);

namespace App\Presentation\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RequestResultTestDto
{
    /**
     * @param QuestionResultDto[] $questions
     */
    public function __construct(
        #[Assert\NotBlank]
        public int $testId,
        #[Assert\NotBlank]
        #[Assert\Valid]
        public array $questions = [],
    ) {
    }
}
