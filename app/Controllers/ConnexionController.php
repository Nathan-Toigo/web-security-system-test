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
		
		if (isset($_POST['safe'])) {
			$safe = $_POST['safe'];
		}
		else{
			$safe = false;
		}

		$pdo = new PDO(constant('DB_DSN'), constant('DB_USER'), constant('DB_PASS'));

		//check cookie
		if (isset($_COOKIE['userToken'])) {
			
			$userPDO = new TokenUserPDO($pdo);
			
			$user = $userPDO->findByToken($_COOKIE['userToken']);
			if ($user !== null) {
				require_once APP_ROOT . '/app/Views/userData.php';
				return;
			}
		}
		
		if(isset($_POST["email"]) && isset($_POST["password"])){
			if($safe){
				$userPDO = new SafeUserPDO($pdo);
			}
			else{
				$userPDO = new VulnerableUserPDO($pdo);
			}
			$user = $userPDO->testUserPassword($_POST["email"], $_POST["password"]);
			if($user !== null){
				//add token in database
				$token = bin2hex(random_bytes(16)); // Generate a secure random token
				$expiresAt = date('Y-m-d H:i:s', strtotime('+1 day')); // Token expires in 1 hour
				$userPDO->addTokenToUser($user->getId(), $token, $expiresAt);
				//add token in cookie
				setcookie('userToken', $token, time() + 86400, '/'); // Cookie expires in 1 day

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

	public function logout(RouteCollection $routes)
	{
		// Clear the cookie
		setcookie('userToken', '', time() - 3600, '/'); // Expire the cookie immediately
		// Redirect to the homepage or login page
		header('Location: ' . constant('URL_SUBFOLDER') . '/connexion');
		exit();
	}
}