<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use Comet\Comet;
use DI\ContainerBuilder;
use Psr\Log\LoggerInterface;

require __DIR__ . '/../vendor/autoload.php';

// Load env
require_once __DIR__ . '/../bootstrap/environment.PHP';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../storage/cache');
}

// Set up settings
$settings = require __DIR__ . '/../bootstrap/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/../bootstrap/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/../bootstrap/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

/** @var SettingsInterface $settings */
$settings = $container->get(SettingsInterface::class);

// Instantiate the app
$app = new Comet([
    'workers' 	=> $settings->get('workers'),
    'host' 		=> $settings->get('host'),
    'port' 		=> $settings->get('port'),
    'debug' 	=> $settings->get('debug'),
    'logger' 	=> $container->get(LoggerInterface::class),
    'container' => $container,
]);

$callableResolver = $app->getCallableResolver();

// Register middleware
$middleware = require __DIR__ . '/../bootstrap/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../bootstrap/routes.php';
$routes($app);

$app->run();