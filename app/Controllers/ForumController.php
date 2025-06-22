<?php 

namespace App\Controllers;

use App\Models\Product;
use App\Models\SafePostPDO;
use App\Models\VulnerablePostPDO;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Attribute\Route;
use PDO;


class ForumController
{
    
	public function show(RouteCollection $routes) 
	{
		$pdo = new PDO(constant('DB_DSN'),constant('DB_USER'), constant('DB_PASS'));

		if (isset($_POST['safePost'])) {
			$safePost = $_POST['safePost'];
		} else {
			$safePost = false;
		}

		if (isset($_POST['safeDisplay'])) {
			$safeDisplay = $_POST['safeDisplay'];
		} else {
			$safeDisplay = false;
		}

		if (isset($_POST['safeCookie'])) {
			$safeCookie = $_POST['safeCookie'];
		} else {
			$safeCookie = false;
		}

		if (isset($_POST['nameCookie']) && isset($_POST['valueCookie'])) {
			if($safeCookie) {
				setcookie($_POST['nameCookie'],$_POST['valueCookie'],['samesite' => 'Strict', 'secure' => true, 'httponly' => true, 'expires' => time() + 3600, 'path' => '/']);
			} else {
				setcookie($_POST['nameCookie'],$_POST['valueCookie'],time() + 3600, "/");
			}
		}


		if(isset($_POST['title']) && isset($_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) {
			try{		
				if($safePost) {
					$postPDO = new SafePostPDO($pdo);

				} else {
					$postPDO = new VulnerablePostPDO($pdo);
				}

				$title = $_POST['title'];
				$content = $_POST['content'];
				if ($safePost) {
					$title = $this->checkInput($title);
					$content = $this->checkInput($content);
				}

				$postPDO->create([
				'title' => $title,
				'content' => $content,
				'creator_id' => 1]);

				$_POST['title'] = '';
				$_POST['content'] = '';
			}
			catch (\PDOException $e) {
				$errorMessage = 'Error creating post: ' . $e->getMessage();
			}
		}

		if ($safeDisplay) {
			$displayPDO = new SafePostPDO($pdo);
		} else {
			$displayPDO = new VulnerablePostPDO($pdo);
		}

		$posts = $displayPDO->getAll();

		unset($_POST['title']);
		unset($_POST['content']);
		
        require_once APP_ROOT . '/app/Views/forum.php';
	}

	private function checkInput($input) {
		return htmlspecialchars(strip_tags(trim($input)));
	}
	
}