<?php

declare(strict_types=1);

arch()
    ->expect('App')
    ->toUseStrictEquality()
    ->toUseStrictTypes()
    ->not->toUse(['die', 'dd', 'dump', 'var_dump', 'print_r']);

arch()
    ->expect('App\Application')
    ->not
    ->toBeUsedIn(['App\Domain']);

arch()
    ->expect(['App\Infrastructure', 'App\Presentation'])
    ->not
    ->toBeUsedIn(['App\Domain', 'App\Application']);

arch()
    ->expect('App\Infrastructure')
    ->toOnlyBeUsedIn(['App\Infrastructure']);

arch()
    ->expect('App\Presentation')
    ->toOnlyBeUsedIn(['App\Presentation']);

arch()
    ->expect('App\controller')
    ->toHaveMethod('__invoke')
    ->not
    ->toHavePublicMethodsBesides('__invoke');
