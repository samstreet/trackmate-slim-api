<?php

use Trackmate\Service\Base as BaseService;
use Slim\App;
use Slim\Container;
use Chadicus\Slim\OAuth2\Routes;
use Chadicus\Slim\OAuth2\Middleware;
use Slim\Http;
use OAuth2\Storage;
use OAuth2\GrantType;
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
$trackmate = [];
$trackmate["sl"] = $core->getServiceLocator();
$trackmate["controllers"] = $core->getControllers();

$storage = new Storage\Pdo($pdo);
$server = new OAuth2\Server(
    $storage,
    [
        'access_lifetime' => 3600,
    ],
    [
        new GrantType\ClientCredentials($storage),
        new GrantType\AuthorizationCode($storage),
    ]
);


$app = new App(new Container($trackmate));

$app->group("/api/ride", function () use ($app) {
    $app->post("/new", RideController::class . ":create");
});

$app->group("/api/v1/", function () use ($app) {
    
    /**
     * User CRUD
     */
    $app->post("user", UserController::class . ":create");
    $app->get("user/{id}", UserController::class . ":fetch");
    $app->patch("user/{id}", UserController::class . ":update");
    $app->delete("user/{id}", UserController::class . ":delete");
    
    /**
     * Authentication
     */
    $app->post('authenticate', AuthController::class . ":authenticate");
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
