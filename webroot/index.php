<?php

// Définition du projet racine

session_start();

define('WEBROOT', dirname(__FILE__));

define('ROOT', dirname(WEBROOT));
define('SERVER', $_SERVER['HTTP_HOST']);

define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT . DS . 'core');

$tmp = (dirname(dirname($_SERVER['SCRIPT_NAME'])));

//Si la base est / les formes ont une mauvaise redirection
define('BASE_URL', $tmp === '/' ? '' : $tmp);
define('BASE_SITE', dirname($_SERVER['SCRIPT_NAME']));

include CORE . DS . 'includes.php';

$d = new Dispatcher();