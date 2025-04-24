<?php

arch()
    ->expect('App')
    ->toUseStrictEquality()
    ->toUseStrictTypes()
    ->not->toUse(['die', 'dd', 'dump', 'var_dump', 'print_r']);

arch()
    ->expect('App\Application')
    ->toOnlyBeUsedIn(['App\Presentation', 'App\Infrastructure']);

arch()
    ->expect('App\controller')
    ->toHaveMethod('__invoke')
    ->not
    ->toHavePublicMethodsBesides('__invoke');