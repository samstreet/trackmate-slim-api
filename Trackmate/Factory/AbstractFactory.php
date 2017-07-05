<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Factory;

use Trackmate\Core\ServiceRegister;

/**
 * Factory to create Service Locators
 *
 * Class AbstractFactory
 * @package Trackmate\Factory
 * @author Sam Street
 *
 */

abstract class AbstractFactory
{
    /**
     * @param ServiceRegister $register
     * @return mixed
     */
    abstract  static function make(ServiceRegister $register);
}