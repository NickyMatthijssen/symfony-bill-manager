<?php

declare(strict_types=1);

namespace App\Presentation\Provider;

use App\Domain\Entity\User;
use App\Presentation\Mapper\PersonalInformationMapper\PersonalInformationMapperInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class PersonalInformationProvider implements PersonalInformationProviderInterface
{
    /**
     * @param iterable<array-key, PersonalInformationMapperInterface> $personalInformationMappers
     */
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
