<?php

declare(strict_types=1);

namespace App\Domain\Aggregates;

use App\Domain\Entities\Test\Test;

class TestAggregate
{
    private Test $test;
    private array $questions;

    public function __construct(Test $test, array $questions)
    {
        $this->test = $test;
        $this->questions = $questions;
    }

    public function getTest(): Test
    {
        return $this->test;
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }
}