<?php

/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Interfaces;

/**
 * Interface IHal
 *
 * Methods detailing how to make Hal structures
 *
 * @package Trackmate\Interfaces
 */
interface IHal
{
    /**
     * Outut the Hal structure
     * @return mixed
     */
    public function output();
    
    /**
     * Generate a Hal structure
     * @return mixed
     */
    public function generate();
    
    /**
     * Make Hal from data
     * @param $data
     * @return mixed
     */
    public function from($data);
}