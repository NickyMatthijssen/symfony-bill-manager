<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class PersonalInformationProvider implements PersonalInformationProviderInterface
{
    public function __construct(
        #[AutowireIterator('mapper.personal_information')]
        private iterable $personalInformationMappers
    ) {
    }

    public function getPersonalInformation(User $user): array
    {
        $information = [];

        foreach ($this->personalInformationMappers as $personalInformationMapper) {
            $information[] = $personalInformationMapper->map($user);
        }

        return $information;
    }
}
