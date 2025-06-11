<?php 

namespace App\Controllers;

use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class ProductController
{
    // Show the product attributes based on the id.
	public function showAction(int $id, RouteCollection $routes)
	{
        $user = new User();
        $user->read($id);

        require_once APP_ROOT . '/app/Views/userData.php';
	}
}