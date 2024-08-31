<?php

declare(strict_types=1);

namespace App\Domain\Services;


use App\Infrastructure\Repository\TestResultRepository;
use Doctrine\Common\Collections\Criteria;

class TestResultHandler
{

    public function __construct(
        private readonly TestResultRepository $testResults
    )
    {
    }

    public function handler(int $testResultId): ?array
    {
        $testResult = $this->testResults->getResultTest($testResultId);
        return $testResult->getResult();
    }
}