<?php

declare(strict_types=1);

namespace App\ValueObjects;

use Doctrine\ORM\Mapping as ORM;
use UnexpectedValueException;

final class Url
{
    private function __construct(
        public string $value {
        get => $this->value;
        },
    ) {
        $this->value = mb_strtolower($this->value);

        if (false === filter_var($this->value, FILTER_VALIDATE_URL)) {
            throw new UnexpectedValueException(sprintf(
                'Expected a valid url but got "%s"',
                $this->value,
            ));
        }
    }

    public static function createFromString(string $url): self
    {
        return new self($url);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
