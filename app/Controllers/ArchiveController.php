<?php 

namespace App\Controllers;

use App\Models\SafeUserPDO;
use App\Models\VulnerableUserPDO;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Models\DocumentPDO;
use App\Models\Document;
use PDO;

class ArchiveController 
{
	public function show(RouteCollection $routes) 
    {
		if (isset($_GET['path'])) {
			$path = $_GET['path'];
		} else {
			$path = 'Document1.txt'; // Default image if none is specified
		}

		if (isset($_GET['safe'])) {
			$safe = filter_var($_GET['safe'], FILTER_VALIDATE_BOOLEAN);
		}
		else{
			$safe = false;
		}

		try{
			if($safe) {
				$loadedDocument = $this->safeGetPath($path);
			} else {
				$loadedDocument = $this->vulnerableGetPath($path);
			}
		} catch (\Exception $e) {
			// Handle the exception, e.g., log it or show an error message
			$loadedDocument = "<div class='alert alert-danger'> Error loading document : File not found </div>		";
		}
		

		$pdo = new PDO(constant('DB_DSN'),constant('DB_USER'), constant('DB_PASS'));
		$archivePDO = new DocumentPDO($pdo);

		$allDocuments = $archivePDO->getAll();
		$currentUrl =SITE_NAME. $_SERVER['REQUEST_URI'];

        require_once APP_ROOT . '/app/Views/archive.php';
	}

	public function safeGetPath(string $document) 
    {
		$safeDocument = basename($document);

        // Build full path to image in PHP container
        $path = APP_ROOT . '/public/document/' . $safeDocument;		

        // Return the image as a binary file response
		if (!file_exists($path)) {
			throw new \Exception("File not found: " . $path);
		}
        return nl2br(file_get_contents($path));
	}

	public function vulnerableGetPath(string $document) 
    {
		$safeDocument = $document;

		

        // Build full path to image in PHP container
        $path = APP_ROOT . '/public/document/' . $safeDocument;		

        // Return the image as a binary file response
		if (!file_exists($path)) {
			throw new \Exception("File not found: " . $path);
		}
        return nl2br(file_get_contents($path));
	}

	public function postDocumentSafe(RouteCollection $routes) 
	{
		if (isset($_POST['filename']) && isset($_POST['content'])) {
			$document = basename($_POST['filename']); // Prevent directory traversal
			$content = $_POST['content'];
			$path = $document;

			// Use escapeshellarg to safely pass arguments to shell
			$escapedPath = escapeshellarg($path);
			$escapedContent = escapeshellarg($content);

			// Create the file using a shell command
			$cmd = "echo $content > ./document/$path";
			shell_exec($cmd);

			// Insert document record into database
			$pdo = new PDO(constant('DB_DSN'), constant('DB_USER'), constant('DB_PASS'));
			$archivePDO = new DocumentPDO($pdo);
			$archivePDO->insertDocument(new Document(['path' => $document]));

			header('Location: ' . SITE_NAME . '/archive');
			exit;
		}
	}

	public function postDocumentVulnerable(RouteCollection $routes) 
	{
		if (isset($_POST['filename']) && isset($_POST['content'])) {
			$document = basename($_POST['filename']); // Prevent directory traversal
			$content = $_POST['content'];
			$path = $document;

			// Create the file using a shell command
			$cmd = "echo $content > ./document/$path";
			shell_exec($cmd);

			// Insert document record into database
			$pdo = new PDO(constant('DB_DSN'), constant('DB_USER'), constant('DB_PASS'));
			$archivePDO = new DocumentPDO($pdo);
			$archivePDO->insertDocument(new Document(['path' => $document]));

			header('Location: ' . SITE_NAME . '/archive');
			exit;
		}
	}
}