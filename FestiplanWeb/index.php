<?php
const PREFIX_TO_RELATIVE_PATH = "/Festiplan/FestiplanWeb";
require $_SERVER[ 'DOCUMENT_ROOT' ] . PREFIX_TO_RELATIVE_PATH . '/lib/vendor/autoload.php';


use application\DefaultComponentFactory;
use yasmf\DataSource;
use yasmf\Router;

$dbConfig = require 'dbconfig.php';

$data_source = new DataSource(
    $dbConfig['db_host'],
    $dbConfig['db_port'],
    $dbConfig['db_name'],
    $dbConfig['db_user'],
    $dbConfig['db_pass'],
    $dbConfig['db_charset']
);
$Factory = new DefaultComponentFactory();
$router = new Router($Factory);
try {
    $router->route(PREFIX_TO_RELATIVE_PATH,$data_source);
} catch (PDOException $e) {
    header('Location: views\Error504.php');
}
