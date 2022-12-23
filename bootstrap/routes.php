<?php

declare(strict_types=1);

use Comet\Comet as App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app
        ->setBasePath('')
        ->group('', function(Group $app) {
            require_once __DIR__ . '/../routes/web.php';
        });
};
