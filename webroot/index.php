<?php

// Définition du projet racine

session_start();

define('WEBROOT', dirname(__FILE__));

define('ROOT', dirname(WEBROOT));
define('SERVER', $_SERVER['HTTP_HOST']);

define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT . DS . 'core');
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('BASE_SITE', dirname($_SERVER['SCRIPT_NAME']));

include CORE . DS . 'includes.php';

$d = new Dispatcher();