<?php

declare(strict_types=1);

namespace App\ValueObjects;

final class Base64
{
    public string $source {
        get => sprintf('data:%s;base64,%s', $this->type, $this->content);
    }

    public function __construct(
        public string $type {
            get => $this->type;
        },
        public string $content {
            get => $this->content;
        },
    ) {
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