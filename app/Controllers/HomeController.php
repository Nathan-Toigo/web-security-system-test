<?php 

namespace App\Controllers;

use App\Models\Product;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Attribute\Route;


class HomeController
{
    
	public function show(RouteCollection $routes) 
	{
		$routeToConnexion = $routes->get('connexion')->getPath();
		$routeToForum = $routes->get('forum')->getPath();
		$routeToGalery = '/archive?path=Document1.txt'; // Default image if none is specified

		$routeToExplainationSQLI = $routes->get('explaination_sqli')->getPath();
		$routeToExplainationXSS = $routes->get('explaination_xss')->getPath();
		$routeToExplainationCSRF = $routes->get('explaination_csrf')->getPath();
		$routeToExplainationOSCI = $routes->get('explaination_osci')->getPath();
		$routeToExplainationDT = $routes->get('explaination_dt')->getPath();

        require_once APP_ROOT . '/app/Views/home.php';	
	}
	
}