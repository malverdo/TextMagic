<?php

declare(strict_types=1);

namespace App\Domain\Test\Entity;

use App\Domain\ValueObject\Title;
use App\Infrastructure\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column]
    private int $id;

    #[ORM\Embedded(class: Title::class)]
    private Title $title;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[ORM\Column]
    private ?bool $isCorrect = null;

    public function getIsCorrect(): ?bool
    {
        return $this->isCorrect;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }
}
