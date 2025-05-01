<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\AvatarGenerator;

use App\Application\Common\FaviconResolverInterface;
use App\Domain\ValueObject\Url;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class GStaticFaviconResolver implements FaviconResolverInterface
{
    private const string GOOGLE_FAVICON_URL = 'https://t3.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=%s&size=%s';
    private const int ICON_SIZE = 64;

    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function resolve(Url $url): ?string
    {
        $response = $this->httpClient->request('GET', sprintf(
            self::GOOGLE_FAVICON_URL,
            $url->value,
            self::ICON_SIZE,
        ));

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        return base64_encode($response->getContent());
    }
}
