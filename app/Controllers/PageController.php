<?php 

namespace App\Controllers;

use App\Models\Product;
use Symfony\Component\Routing\RouteCollection;

class PageController
{
    // Homepage action
	public function indexAction(RouteCollection $routes)
	{
		$routeToConnexion = $routes->get('connexion')->getPath();

        require_once APP_ROOT . '/app/Views/home.php';
	}
}