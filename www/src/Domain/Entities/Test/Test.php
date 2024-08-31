<?php

declare(strict_types=1);

namespace App\Domain\Entities\Test;

use App\Domain\ValueObject\Title;
use App\Infrastructure\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column]
    private int $id;

    #[ORM\Embedded(class: Title::class)]
    private Title $title;

    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: 'test', cascade: ['persist'])]
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }
}
