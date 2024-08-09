<?php

/*error_reporting(0); // No reportar ningún tipo de error*/
/*ini_set('display_errors', 'Off'); // No mostrar errores en la salida*/

$appEnv = $_SERVER['APP_ENV'];

// Workaround for ivoz-api deprecation warnings breaking api spec on the first run
$_SERVER['APP_ENV'] = 'prod';

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) use($appEnv) {
    if ($appEnv) {
        $_SERVER['APP_ENV'] = $appEnv;
    }
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
