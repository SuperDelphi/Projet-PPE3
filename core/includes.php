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
require_once ROOT . DS . 'model' . DS . 'Division.php';
require_once ROOT . DS . 'model' . DS . 'Classement.php';
require_once ROOT . DS . 'model' . DS . 'Equipe.php';
require_once ROOT . DS . 'model' . DS . 'Remplacement.php';
require_once ROOT . DS . 'model' . DS . 'Rencontre.php';
require_once ROOT . DS . 'model' . DS . 'Journee.php';

// Scripts
require_once ROOT . DS . 'scripts' . DS . 'ArrayWizard.php';
require_once ROOT . DS . 'scripts' . DS . 'IP.php';
require_once ROOT . DS . 'scripts' . DS . 'Parser.php';
require_once ROOT . DS . 'scripts' . DS . 'Security.php';