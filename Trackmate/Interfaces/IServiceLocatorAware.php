<?php

namespace Trackmate\Interfaces;

interface IServiceLocatorAware
{
    /**
     * Get a servcice
     * @param $identifier
     * @return mixed
     */
    public function get($identifier);
    
    /**
     * Register a new service
     * @param $identifier
     * @param $service
     * @param array $params
     * @return mixed
     */
    public function register($identifier, $service, $params = []);
    
    /**
     * Do we have a service
     * @param $identifier
     * @return mixed
     */
    public function has($identifier);
}