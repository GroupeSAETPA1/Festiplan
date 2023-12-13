<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname(dirname(dirname($vendorDir)));

return array(
    'yasmf\\' => array($vendorDir . '/yasmf/yasmf/src/yasmf'),
    'services\\' => array($baseDir . '/FestiplanWeb/services'),
    'controllers\\' => array($baseDir . '/FestiplanWeb/controllers', $vendorDir . '/yasmf/yasmf/tests/controllers'),
    'application\\' => array($baseDir . '/FestiplanWeb/application'),
    'PhpParser\\' => array($vendorDir . '/nikic/php-parser/lib/PhpParser'),
    'DeepCopy\\' => array($vendorDir . '/myclabs/deep-copy/src/DeepCopy'),
);
