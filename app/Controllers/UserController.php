<?php 

namespace App\Controllers;

use App\Models\User;
use Symfony\Component\Routing\RouteCollection;
use App\Models\UserPDO;
use App\Models\TokenUserPDO;
use PDO;

class UserController
{
    // Show the product attributes based on the id.
	public function show(RouteCollection $routes)
	{
        $pdo = new PDO(constant('DB_DSN'), constant('DB_USER'), constant('DB_PASS'));

        if (isset($_COOKIE['userToken'])) {
			
			$userPDO = new TokenUserPDO($pdo);
			
			$user = $userPDO->findByToken($_COOKIE['userToken']);
			if ($user !== null) {
                require_once APP_ROOT . '/app/Views/userProfile.php';
			}
		}
	}

    public function showSettings(RouteCollection $routes)
    {
        // Assuming you have a User model to fetch user settings
        $user = new User();

        require_once APP_ROOT . '/app/Views/userSettings.php';
    }

    public function updateEmail(RouteCollection $routes)
	{
        $pdo = new PDO(constant('DB_DSN'), constant('DB_USER'), constant('DB_PASS'));

        if (isset($_POST['email']) && isset($_COOKIE['userToken'])) {
            $email = $_POST['email'];
            $token = $_COOKIE['userToken'];

            $userPDO = new UserPDO($pdo);

            $userPDO->updateEmailByToken($token, $email);

            header('Location: ' . $routes->get('user')->getPath());
            echo "<script>alert('Email updated successfully!');</script>";
            exit();


        } else {
            echo "Email and token are required.";
        }
	}
}