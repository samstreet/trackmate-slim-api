<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Core;

use Trackmate\Interfaces\IServiceLocatorAware;

class ServiceLocator implements IServiceLocatorAware
{
    protected $register;
    
    public function __construct(ServiceRegister $register)
    {
        $this->register = $register;
    }
    
    /**
     * Get a servcice
     * @param $identifier
     * @return mixed
     */
    public function get($identifier)
    {
        return $this->register->get($identifier);
    }
    
    /**
     * Register a new service
     * @param $identifier
     * @param $service
     * @param array $params
     * @return mixed
     */
    public function register($identifier, $service, $params = [])
    {
        return $this->register->register($identifier, $service, $params);
    }
    
    /**
     * Do we have a service
     * @param $identifier
     * @return mixed
     */
    public function has($identifier)
    {
        return $this->register->has($identifier);
    }
    
    
}