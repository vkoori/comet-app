<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'workers'   => env('workers', 0),
                'host'      => env('host', '0.0.0.0'),
                'port'      => env('port', 80),
                'debug'     => env('debug', false),
                'logger'    => [
                    'name' => 'comet-app',
                    'path' => __DIR__ . '/../storage/log/comet-app.log',
                    'level' => Logger::DEBUG,
                ],
            ]);
        }
    ]);
};
