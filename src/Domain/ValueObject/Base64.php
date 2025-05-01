<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final readonly class Base64
{
    public function __construct(
        private string $type,
        private string $content,
    ) {
    }

    public function getSource(): string
    {
        return sprintf('data:%s;base64,%s', $this->type, $this->content);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public static function createFromContent(string $type, string $content): self
    {
        $base64 = base64_encode($content);
        return new self($type, $base64);
    }

    public static function createFromBase64(string $type, string $base64Content): self
    {
        return new self($type, $base64Content);
    }
}
