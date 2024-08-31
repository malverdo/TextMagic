<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Infrastructure\Repository\TestResultRepository;

class TestResultHandler
{
    public function __construct(
        private readonly TestResultRepository $testResults,
    ) {
    }

    public function handler(int $testResultId): ?array
    {
        $testResult = $this->testResults->getResultTest($testResultId);

        return $testResult->getResult();
    }
}
