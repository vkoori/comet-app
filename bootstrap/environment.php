<?php 

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__, 1));
$dotenv->safeLoad();

function env(string $key, mixed $default=Null)
{
	if ( !isset($_ENV[$key]) ) {
		return $default;
	}

	$value = $_ENV[$key];
	switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'empty':
        case '(empty)':
            return '';
        case 'null':
        case '(null)':
            return;
    }

    if (preg_match('/\A([\'"])(.*)\1\z/', $value, $matches)) {
        return $matches[2];
    }

    return $value;
}