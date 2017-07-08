<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Interfaces\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

interface ICRUD
{
    /**
     * Create
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function create(Request $request, Response $response);
    
    /**
     * Save
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function save(Request $request, Response $response);
    
    /**
     * Delete
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function delete(Request $request, Response $response);
    
    /**
     * Update
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function update(Request $request, Response $response);
    
    /**
     * Fetch
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function fetch(Request $request, Response $response);
}