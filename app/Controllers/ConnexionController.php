<?php 

namespace App\Controllers;

use App\Models\SafeUserPDO;
use App\Models\TokenUserPDO;
use App\Models\VulnerableUserPDO;
use App\Models\UserPDO;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PDO;

class ConnexionController
{
	public function show(RouteCollection $routes) 
	{

		if (isset($_POST['safeConnection'])) {
			$safeConnection = $_POST['safeConnection'];
		}
		else{
			$safeConnection = false;
		}

		$pdo = new PDO(constant('DB_DSN'), constant('DB_USER'), constant('DB_PASS'));

		//check cookie
		if (isset($_SESSION['userToken'])) {
			
			$userPDO = new TokenUserPDO($pdo);
			
			$user = $userPDO->findByToken($_SESSION['userToken']);
			if ($user !== null) {
				header('Location: ' . constant('URL_SUBFOLDER') . '/user');
				exit();
			}
		}
		
		if(isset($_POST["email"]) && isset($_POST["password"])){
			if($safeConnection){
				$userPDO = new SafeUserPDO($pdo);
			}
			else{
				$userPDO = new VulnerableUserPDO($pdo);
			}
			$user = $userPDO->testUserPassword($_POST["email"], $_POST["password"]);
			if($user !== null){
				//add token in database
				$userToken = bin2hex(random_bytes(16)); // Generate a secure random token
				$expiresAt = date('Y-m-d H:i:s', strtotime('+1 day')); // Token expires in 1 hour
				$userPDO->addTokenToUser($user->getId(), $userToken, $expiresAt);

				$_SESSION['userToken'] = $userToken; // Store the token in the session

				$csrfToken = bin2hex(random_bytes(16));
				$_SESSION['csrfToken'] = $csrfToken; 

				header('Location: ' . constant('URL_SUBFOLDER') . '/user');
				exit();
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

	public function logout(RouteCollection $routes)
	{
		session_destroy();
		header('Location: ' . constant('URL_SUBFOLDER') . '/connexion');
		exit();
	}
}