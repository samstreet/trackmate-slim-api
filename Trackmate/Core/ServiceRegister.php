<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Core;

use Trackmate\Interfaces\IServiceLocatorAware;

class ServiceRegister implements IServiceLocatorAware
{
    /**
     * The register of services
     * @var
     */
    protected $register = [];
    
    public function __construct()
    {
    }
    
    /**
     * Register a new service with the collection
     * @param $identifier
     * @param $service
     * @return Collection
     */
    public function register($identifier, $service, $params = [])
    {
        $this->register[$identifier] = [
            "class" => $service
        ];
        
        return $this->register;
    }
    
    /**
     * Get a servcice
     * @param $identifier
     * @return mixed
     */
    public function get($identifier)
    {
        return $this->register[$identifier]['class'];
    }
    
    /**
     * Do we have a service
     * @param $identifier
     * @return mixed
     */
    public function has($identifier)
    {
        return isset($this->register[$identifier]);
    }
    
    
}
