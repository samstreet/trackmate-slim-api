<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Controller;

use Slim\Container;
use Trackmate\Interfaces\IServiceLocatorAware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use OAuth2\HttpFoundationBridge\Request as BridgeRequest;
use OAuth2;

class BaseController implements IServiceLocatorAware
{
    protected $app;
    
    protected $server;
    
    public function __construct(Container $app)
    {
        $this->app = $app;
    
        OAuth2\Autoloader::register();
    
        $storage = new OAuth2\Storage\Pdo(
            [
                'dsn' => DB_DSN,
                'username' => DB_USER,
                'password' => DB_PASS
            ]
        );
    
        $server = new OAuth2\Server($storage);
        $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
        $server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));
        
        $this->server = $server;
    }
    
    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function token(Request $request, Response $response, $args)
    {
        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyRequest = $httpFoundationFactory->createRequest($request);
        $bridgeRequest = BridgeRequest::createFromRequest($symfonyRequest);
        
        $this->server->handleTokenRequest($bridgeRequest)->send();
    }
    
    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param array                                    $next
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function validateToken($request)
    {
        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyRequest = $httpFoundationFactory->createRequest($request);
        $bridgeRequest = BridgeRequest::createFromRequest($symfonyRequest);
        
        if (!$this->server->verifyResourceRequest($bridgeRequest)) {
            $this->server->getResponse()->send();
            die;
        }
        
        // store the user_id
        $token = $this->server->getAccessTokenData($bridgeRequest);
        $this->user = $token['user_id'];
        
        return TRUE;
    }
    
    public function get($identifier)
    {
        return $this->app->get("sl")->get($identifier);
    }
    
    public function register($identifier, $service, $params = [])
    {
        throw new \Exception("Method Not Used");
    }
    
    public function has($identifier)
    {
        return $this->app->get("sl")->has($identifier);
    }
    
    public function getUserService()
    {
        return $this->get("user");
    }
    
    public function getAuthService()
    {
        return $this->get("auth");
    }
    
    public function app()
    {
        return $this->app;
    }
    
}