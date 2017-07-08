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
use Trackmate\Models\Ride;
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
        
        
        return ApiProblemResponse::json(404, 'User with id 5 not found.', 'Not Found', 'user.not_found', [])->withHeader("Content-Type", "application/hal+json");
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
        $user = new User();
        $user->setId(1);
        $user->setFirstName("Sam");
        $user->setLastName("Street");
        
        $mappings = [
            [
                'class' => User::class,
                'alias' => 'User',
                'aliased_properties' => [],
                'hide_properties' => [
                    "firstName",
                    "lastName",
                    "rides",
                    "username",
                    "password",
                    "email",
                    "access_token",
                    "refresh_token"
                ],
                'id_properties' => [
                    'id',
                ],
                'urls' => [
                    'self' => 'http://vhost1.example.com/api/v1/user/{id}',
                    'user' => 'http://vhost1.example.com/api/v1/user'
                ],
                'curies' => [
                    'name' => 'user',
                    'href' => 'http://vhost1.example.com/docs/rels/{rel}',
                ]
            ]
        ];
        
        $mapper = new Mapper($mappings);
        $transformer = new JsonTransformer($mapper);
        $serializer = new HalSerializer($transformer);
        $output = $serializer->serialize($user);
        $hal = new HalResponse($output);
        
        $body = json_decode((string)$hal->getBody());
        
        $response = $response->withJson($body);
        $response = $response->withHeader("Content-Type", "application/hal+json");
        
        return $response;
    }
}