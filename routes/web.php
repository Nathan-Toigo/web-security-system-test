<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'HomeController', 'method'=>'show')));
$routes->add('connexion', new Route(constant('URL_SUBFOLDER') . '/connexion', array('controller' => 'ConnexionController', 'method'=>'show')));
$routes->add('forum', new Route(constant('URL_SUBFOLDER') . '/forum', array('controller' => 'ForumController', 'method'=>'show')));
$routes->add('archive', new Route(constant('URL_SUBFOLDER') . '/archive', array('controller' => 'ArchiveController', 'method'=>'show')));