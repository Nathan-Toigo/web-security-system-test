<?php 

namespace App\Controllers;

use App\Models\Product;
use App\Models\VulnerablePostPDO;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Attribute\Route;
use PDO;


class ForumController
{
    
	public function show(RouteCollection $routes) 
	{
		$pdo = new PDO(constant('DB_DSN'),constant('DB_USER'), constant('DB_PASS'));
		$userPDO = new VulnerablePostPDO($pdo);

		$posts = $userPDO->getAll();
		
        require_once APP_ROOT . '/app/Views/forum.php';
	}
	
}