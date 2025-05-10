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
    ->toBeUsedIn(['App\Domain', 'Tests']);

arch()
    ->expect(['App\Infrastructure', 'App\Presentation'])
    ->not
    ->toBeUsedIn(['App\Domain', 'App\Application', 'Tests']);

arch()
    ->expect('App\Infrastructure')
    ->toOnlyBeUsedIn(['App\Infrastructure', 'Tests']);

arch()
    ->expect('App\Presentation')
    ->toOnlyBeUsedIn(['App\Presentation', 'Tests']);

arch()
    ->expect('App\controller')
    ->toHaveMethod('__invoke')
    ->not
    ->toHavePublicMethodsBesides('__invoke');
