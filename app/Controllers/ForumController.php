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
			try{
				$postPDO->create([
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'creator_id' => 1]);
			}
			catch (\PDOException $e) {
				$errorMessage = 'Error creating post: ' . $e->getMessage();
			}
		}

		setcookie('importantInformation', "Session token",time() + 3600, "/");
		setcookie('importantInformationSafe',"Session token Safe",['samesite' => 'Strict', 'secure' => true, 'httponly' => true, 'expires' => time() + 3600, 'path' => '/']);


		$posts = $postPDO->getAll();

		unset($_POST['title']);
		unset($_POST['content']);
		
        require_once APP_ROOT . '/app/Views/forum.php';
	}
	
}