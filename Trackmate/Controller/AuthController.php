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
     * @param Request $request
     * @param Response $response
     */
    public function authenticate(Request $request, Response $response)
    {
        
        return ApiProblemResponse::json(
            403,
            "Invalid Credentials",
            "Authentication Error",
            "error.authentication"
        );
        
    }
    
    public function refresh(Request $request, Response $response)
    {
    
    }
}