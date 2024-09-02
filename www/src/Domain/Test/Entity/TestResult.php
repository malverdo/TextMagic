<?php

namespace App\Domain\Test\Entity;

use App\Infrastructure\Repository\TestResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestResultRepository::class)]
class TestResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $testId;

    #[ORM\Column]
    private array $result = [];

    public function __construct(int $testId, array $result)
    {
        $this->testId = $testId;
        $this->result = $result;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
