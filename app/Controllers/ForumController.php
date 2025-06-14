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
		$postPDO = new VulnerablePostPDO($pdo);

		if(isset($_POST['title']) && isset($_POST['content'])) {
			if(!$postPDO->create([
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'creator_id' => 1])){
				$errorMessage = "An error occurred while creating the post.";
			}
		}

		$posts = $postPDO->getAll();

		unset($_POST['title']);
		unset($_POST['content']);
		
        require_once APP_ROOT . '/app/Views/forum.php';
	}
	
}