<?php 

namespace App\Controllers;

use App\Models\SafeUserPDO;
use App\Models\VulnerableUserPDO;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PDO;

class ConnexionController
{
	public function show(RouteCollection $routes) 
	{
		
		if (isset($_POST['safe'])) {
			$safe = $_POST['safe'];
		}
		else{
			$safe = false;
		}
		
		if(isset($_POST["email"]) && isset($_POST["password"])){
			$pdo = new PDO(constant('DB_DSN'),constant('DB_USER'), constant('DB_PASS'));
			if($safe){
				$userPDO = new SafeUserPDO($pdo);
			}
			else{
				$userPDO = new VulnerableUserPDO($pdo);
			}
			$user = $userPDO->testUserPassword($_POST["email"], $_POST["password"]);
			if($user !== null){
				
				require_once APP_ROOT . '/app/Views/userData.php';
			}
			else{
				//else, print connexion with error message
				$errorMessage = "Invalid credentials. Please try again.";
				require_once APP_ROOT . '/app/Views/connexion.php';
			}
		}
		else{
			require_once APP_ROOT . '/app/Views/connexion.php';
		}

		

	}
}