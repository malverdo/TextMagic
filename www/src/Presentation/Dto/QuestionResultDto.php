<?php

namespace App\Presentation\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class QuestionResultDto
{
    /**
     * @param int[] $answerIds
     */
    public function __construct(
        #[Assert\NotBlank]
        public int $id,
        #[Assert\All(
            new Assert\Type(
                type: 'integer',
                message: 'Each answerId must be an integer'
            )
        )]
        public array $answerIds = [],
    ) {
    }
}