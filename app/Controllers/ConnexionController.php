<?php 

namespace App\Controllers;

use App\Models\UserPDO;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PDO;

class ConnexionController extends AbstractController
{
	public function showAction(RouteCollection $routes) 
	{
		$pdo = new PDO(constant('DB_DSN'),constant('DB_USER'), constant('DB_PASS'));
		$userPDO = new UserPDO($pdo);
		$user = $userPDO->findById(1);
		
		if(isset($submit)){

		}

		//try the password

		//if good, redirect to userData
		//else, print connexion with error message

        require_once APP_ROOT . '/app/Views/userData.php';
	}
}