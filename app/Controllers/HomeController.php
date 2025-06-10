<?php 

namespace App\Controllers;

use App\Models\Product;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Attribute\Route;


class HomeController
{
    
	public function show(RouteCollection $routes) 
	{

        require_once APP_ROOT . '/app/Views/home.php';
	}
	
}