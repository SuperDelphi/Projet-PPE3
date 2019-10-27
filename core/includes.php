<?php

// Fichier de configuration
require ROOT . DS . 'config' . DS . 'conf.php';

// Cœurs
require 'Router.php';
require 'Request.php';
require 'Dispatcher.php';
require 'Controller.php';
require 'Model.php';
require 'Session.php';

// Modèles
require_once ROOT . DS . 'model' . DS . 'Personne.php';
require_once ROOT . DS . 'model' . DS . 'Compte.php';
require_once ROOT . DS . 'model' . DS . 'Arbitre.php';
require_once ROOT . DS . 'model' . DS . 'Joueur.php';
require_once ROOT . DS . 'model' . DS . 'Championnat.php';

// Scripts
require_once ROOT . DS . 'scripts' . DS . 'Security.php';