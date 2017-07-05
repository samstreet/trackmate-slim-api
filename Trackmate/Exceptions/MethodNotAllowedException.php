<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Exceptions;

use \Exception;

/**
 * Class MethodNotAllowedException
 * @package Trackmate\Exceptions
 */
class MethodNotAllowedException extends Exception
{
    public function __construct()
    {
        parent::__construct("Method Not Allowed", 500);
    }
}