<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Stream;
use Trackmate\Service\HalService;
use Trackmate\Service\User\UserAuthenticationService;
use Exception;

/**
 * Class AuthController
 * @package Trackmate\Controller
 */
class AuthController extends BaseController
{
    public function authenticate(Request $request, Response $response)
    {
        $request->withHeader("Accept", "application/json");
        $postData = json_decode($request->getBody(), true);
        $response->withHeader("Content-Type", "application/json");
        $body = null;
        
        try {
            $login = $this->get(UserAuthenticationService::class)->authenticate($postData['username'], $postData['password']);
            http_response_code(200);
            $body = $this->get(HalService::class)->from($login);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            $body = [
                "error" => $e->getMessage()
            ];
        }

        $response = $response->withJson($body);
        
        return $response;
        
    }
    
    public function refresh(Request $request, Response $response)
    {
    }
}