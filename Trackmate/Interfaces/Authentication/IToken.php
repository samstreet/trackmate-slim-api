<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Interfaces\Authentication;

/**
 * Interface IToken
 */
interface IToken
{
    /**
     * Create a token
     * @return mixed
     */
    public function create();
    
    /**
     * Validates if a token is valid
     * @param $token
     * @return mixed
     */
    public function validate($token);
}