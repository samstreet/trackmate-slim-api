<?php

use Trackmate\Service\Base as BaseService;
use Slim\App;
use Slim\Container;
use Trackmate\Core\Resolver;
use Trackmate\Controller\HomeController;
use Trackmate\Controller\AuthController;
use Trackmate\Controller\UserController;
use Trackmate\Controller\RideController;

require '../vendor/autoload.php';

define('__ROOT__', '/');
if ($_SERVER['HTTP_HOST'] == "dev.trackmate.com" || $_SERVER['HTTP_HOST'] == "0.0.0.0:8080") {
    define('__ENVIRONMENT__', 'dev');
} else {
    define('__ENVIRONMENT__', 'live');
}

define('DB_DSN', 'mysql:host=127.0.0.1;dbname=trackmate;charset=utf8');
define('DB_USER', 'trackmate');
define('DB_PASS', 'trackmate');

$resolver = new Resolver();
$core = $resolver->resolve("Trackmate\Trackmate")->bootstrap();
$trackmate["sl"] = $core->getServiceLocator();
$trackmate["controllers"] = $core->getControllers();

$app = new App(new Container($container));

$app->group("/api/ride", function () use ($app) {
    $app->post("/new", RideController::class . ":create");
});

$app->group("/api/v1", function () use ($app) {
    
    /**
     * User CRUD
     */
    $app->post("/user", UserController::class . "create");
    $app->get("/user/{id}", UserController::class . "fetch");
    $app->patch("/user/{id}", UserController::class . "update");
    $app->delete("/user/{id}", UserController::class . "delete");
    
    /**
     * Ride CRUD
     */
    $app->post("/ride", RideController::class . "create");
    $app->get("/ride/{id}", RideController::class . "fetch");
    $app->patch("/ride/{id}", RideController::class . "update");
    $app->delete("/ride/{id}", RideController::class . "delete");
    
    /**
     * Autehtnication
     */
    $app->post('/authenticate', AuthController::class . ":authenticate");
});

/**
 * Site pages
 */
$app->get('/', HomeController::class . ":index");
$app->get('/about', HomeController::class . ":about");
$app->get('/contact-us', HomeController::class . ":contact");
$app->get('/register', HomeController::class . ":registration");
$app->get('/log-in', HomeController::class . ":login");

/**
 * End SIte Pages
 */



$app->run();
