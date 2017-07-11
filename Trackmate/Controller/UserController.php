<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Trackmate\Interfaces\Controllers\ICrud;
use NilPortugues\Api\Problem\ApiProblemResponse;
use NilPortugues\Api\Mapping\Mapper;
use Trackmate\Models\User;
use NilPortugues\Api\Hal\JsonTransformer;
use NilPortugues\Api\Hal\HalSerializer;
use NilPortugues\Api\Hal\Http\Response\Response as HalResponse;

/**
 * Class UserController
 * @package Trackmate\Controller
 */
class UserController extends BaseController implements ICrud
{
    
    /**
     * Create
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function create(Request $request, Response $response)
    {
        return ApiProblemResponse::json(404, 'User with id 5 not found.', 'Not Found', 'user.not_found', [])->withHeader("Content-Type", "application/probelm+json");
    }
    
    /**
     * Save
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function save(Request $request, Response $response)
    {
        return ApiProblemResponse::json(404, 'User with id 5 not found.', 'Not Found', 'user.not_found', []);
    }
    
    /**
     * Delete
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function delete(Request $request, Response $response)
    {
        return ApiProblemResponse::json(404, 'User with id 5 not found.', 'Not Found', 'user.not_found', []);
    }
    
    /**
     * Update
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function update(Request $request, Response $response)
    {
        return ApiProblemResponse::json(404, 'User with id 5 not found.', 'Not Found', 'user.not_found', []);
    }
    
    /**
     * Fetch
     *
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     */
    public function fetch(Request $request, Response $response)
    {
        
//        $user = $this->getAuthService()->authenticate();
//
//        if(null == $user){
//            return new ApiProblemResponse();
//        }
//
//        return $response;
    }
}