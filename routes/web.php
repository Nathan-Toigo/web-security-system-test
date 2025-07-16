<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'HomeController', 'method'=>'show')));
$routes->add('connexion', new Route(constant('URL_SUBFOLDER') . '/connexion', array('controller' => 'ConnexionController', 'method'=>'show')));
$routes->add('forum', new Route(constant('URL_SUBFOLDER') . '/forum', array('controller' => 'ForumController', 'method'=>'show')));
$routes->add('archive', new Route(constant('URL_SUBFOLDER') . '/archive', array('controller' => 'ArchiveController', 'method'=>'show')));
$routes->add('logout', new Route(constant('URL_SUBFOLDER') . '/logout', array('controller' => 'ConnexionController', 'method'=>'logout')));

$routes->add('user_settings_email_safe', new Route(constant('URL_SUBFOLDER') . '/user/settings/update-email-safe', array('controller' => 'UserController', 'method'=>'updateEmailSafe')));
$routes->add('user_settings_email_vulnerable', new Route(constant('URL_SUBFOLDER') . '/user/settings/update-email-vulnerable', array('controller' => 'UserController', 'method'=>'updateEmailVulnerable')));

$routes->add('user', new Route(constant('URL_SUBFOLDER') . '/user', array('controller' => 'UserController', 'method'=>'show')));
$routes->add('user_settings', new Route(constant('URL_SUBFOLDER') . '/user/settings', array('controller' => 'UserController', 'method'=>'showSettings')));

$routes->add('post_document_safe', new Route(constant('URL_SUBFOLDER') . '/archive/post-document-safe', array('controller' => 'ArchiveController', 'method'=>'postDocumentSafe')));
$routes->add('post_document_vulnerable', new Route(constant('URL_SUBFOLDER') . '/archive/post-document-vulnerable', array('controller' => 'ArchiveController', 'method'=>'postDocumentVulnerable')));
