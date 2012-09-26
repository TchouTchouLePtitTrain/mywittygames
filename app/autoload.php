<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = require __DIR__.'/../vendor/autoload.php';

// intl
if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';

    $loader->add('', __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs');
}

//Autoload du sdk AWS
require_once __DIR__.'/../vendor/amazonwebservices/aws-sdk-for-php/sdk.class.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
