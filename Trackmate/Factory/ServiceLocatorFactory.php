<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Factory;

use Trackmate\Core\ServiceLocator;
use Trackmate\Core\ServiceRegister;

/**
 * Class ServiceLocatorFactory
 * @package Trackmate\Factory
 */
class ServiceLocatorFactory extends AbstractFactory
{
    /**
     * Make a ServiceLocator
     *
     * @param ServiceRegister $register the service register
     *
     * @return ServiceLocator
     */
    public static function make(ServiceRegister $register)
    {
        return new ServiceLocator($register);
    }
    
}