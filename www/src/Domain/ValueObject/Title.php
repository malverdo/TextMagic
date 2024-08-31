<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Title
{
    #[ORM\Column(type: 'string', length: 255)]
    private string $value;

    public function __construct(string $value)
    {
        $this->ensureIsValidTitle($value);
        $this->value = $value;
    }

    private function ensureIsValidTitle(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Title cannot be empty');
        }

        if (strlen($value) > 255) {
            throw new InvalidArgumentException('Title cannot exceed 255 characters');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
