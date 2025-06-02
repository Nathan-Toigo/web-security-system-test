<?php

class Router
{
    public function handleRequest()
    {
        $controllerName = $_GET['controller'] ?? 'home';
        $action = $_GET['action'] ?? 'index';

        $controllerClass = ucfirst($controllerName) . 'controller';
        $controllerFile = __DIR__ . '/../app/controller/' . $controllerClass . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerClass();

            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                echo "Action '$action' not found.";
            }
        } else {
            echo "Controller '$controllerClass' not found.";
        }
    }
}
