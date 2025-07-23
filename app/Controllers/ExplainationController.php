<?php 

namespace App\Controllers;

use App\Models\SafeUserPDO;
use App\Models\TokenUserPDO;
use App\Models\VulnerableUserPDO;
use App\Models\UserPDO;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PDO;

class ExplainationController
{
	public function showSQLI(RouteCollection $routes) 
	{
        require_once APP_ROOT . '/explainations/sqli.php';
	}

    public function showXSS(RouteCollection $routes) 
	{
        require_once APP_ROOT . '/explainations/xss.php';
	}

    public function showCSRF(RouteCollection $routes) 
    {
        require_once APP_ROOT . '/explainations/csrf.php';
    }

    public function showOSCI(RouteCollection $routes) 
    {
        require_once APP_ROOT . '/explainations/osci.php';
    }

    public function showDT(RouteCollection $routes) 
    {
        require_once APP_ROOT . '/explainations/dt.php';
	
	}

}