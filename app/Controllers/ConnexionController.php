<?php 

namespace App\Controllers;

use App\Models\UserPDO;
use Symfony\Component\Routing\RouteCollection;
use PDO;

class ConnexionController
{
    // Show the product attributes based on the id.
	public function showAction(RouteCollection $routes)
	{
		$pdo = new PDO(constant('DB_DSN'),constant('DB_USER'), constant('DB_PASS'));
		$userPDO = new UserPDO($pdo);
		

		//try the password

		//if good, redirect to userData with user data
		//else, print connexion with error message

        require_once APP_ROOT . '/app/Views/connexion.php';
	}
}