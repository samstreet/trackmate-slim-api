<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use NilPortugues\Api\Problem\ApiProblemResponse;
use Trackmate\Service\HalService;
use Trackmate\Service\User\UserAuthenticationService;
use Exception;
use OAuth2;
use OAuth2\Server;
use Symfony\Bridge;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use OAuth2\HttpFoundationBridge\Request as BridgeRequest;

/**
 * Class AuthController
 *
 * @package Trackmate\Controller
 */
class AuthController extends BaseController
{
    /**
     * Authenticate a user
     *
     * @param Request $request The request we are making
     * @param Response $response Our response object
     *
     * @return Response|mixed
     */
    public function authenticate(Request $request, Response $response)
    {
        die(var_dump($this->validateToken($request)));
        if ($this->validateToken($request)) {
        
        }
        return $response;
    }
    
    public function refresh(Request $request, Response $response)
    {
    
    }
}