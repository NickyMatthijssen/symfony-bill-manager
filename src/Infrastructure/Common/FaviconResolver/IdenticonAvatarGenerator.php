<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\FaviconResolver;

use App\Application\Common\AvatarGeneratorInterface;
use App\Domain\ValueObject\Base64;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class IdenticonAvatarGenerator implements AvatarGeneratorInterface
{
    private const string API_URL = 'https://api.dicebear.com/9.x/identicon/svg?seed=%s';
    private const string CONTENT_TYPE_KEY = 'content-type';

    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function generate(string $seed): Base64
    {
        $response = $this->httpClient->request('GET', sprintf(
            self::API_URL,
            $seed,
        ));

        $type = $response->getHeaders()[self::CONTENT_TYPE_KEY][0];
        return Base64::createFromContent($type, $response->getContent());
    }
}
