<?php
/**
 * Description dependency injection and routing
 */
namespace App;

use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;
use PDO;
use FastRoute\Dispatcher;

/**
 * Building dependency injection for classes
 * 
 * @return object
 */
$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(
    [
    Engine::class    =>  function () {
        return new Engine('../app/Views');
    },
    QueryFactory::class => function () {
        return new QueryFactory('mysql');
    },
    PDO::class => function () {
        return new PDO('mysql:host=localhost;dbname=spmsystem;charset=utf8', 'root', '');
    }
    ]
);
$container = $containerBuilder->build();

/**
 * Set routes for pages of project
 */
$dispatcher = \FastRoute\simpleDispatcher(
    function (\FastRoute\RouteCollector $r) {
        /**
         * @param integet {id} must be a number (\d+)
         */
        $r->addRoute('GET', '/store/{page:\d+}', ['App\Controllers\MainController', 'store']);
        $r->addRoute('GET', '/create', ['App\Controllers\MainController', 'create']);
        $r->addRoute('POST', '/add', ['App\Controllers\MainController', 'add']);
        $r->addRoute('GET', '/show/{id:\d+}', ['App\Controllers\MainController', 'show']);
        $r->addRoute('GET', '/edit/{id:\d+}', ['App\Controllers\MainController', 'edit']);
        $r->addRoute('POST', '/update/{id:\d+}', ['App\Controllers\MainController', 'update']);
        $r->addRoute('GET', '/delete/{id:\d+}', ['App\Controllers\MainController', 'delete']);
    }
);

/**
 * Fetch method and URI from somewhere
 */
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

/**
 * Strip query string (?foo=bar) and decode URI
 */
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

/**
 * Dispatcher. Call handler with parameters
 */
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
case Dispatcher::NOT_FOUND:
    echo '404 | Not Found';
    break;
case Dispatcher::METHOD_NOT_ALLOWED:
    $allowedMethods = $routeInfo[1];
    echo '405 | Method Not Allowed';
    break;
case Dispatcher::FOUND:
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];
    $container->call($handler, $vars);
    break;
};
