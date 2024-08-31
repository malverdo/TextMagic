<?php

namespace App\Domain\Entities\Test;

use App\Infrastructure\Repository\TestResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestResultRepository::class)]
class TestResult
{
    #[ORM\Id]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $testId;

    #[ORM\Column]
    private array $result = [];


    /**
     * @param int $testId
     * @param array $result
     */
    public function __construct(int $id, int $testId, array $result)
    {
        $this->id = $id;
        $this->testId = $testId;
        $this->result = $result;
    }

    public function getResult(): array
    {
        return $this->result;
    }
}