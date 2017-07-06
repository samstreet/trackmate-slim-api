<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Service;


use Trackmate\Interfaces\IHal;

class HalService implements IHal
{
    /**
     * @inheritDoc
     */
    public function output()
    {
        // TODO: Implement output() method.
    }
    
    /**
     * @inheritDoc
     */
    public function generate()
    {
        // TODO: Implement generate() method.
    }
    
    /**
     * @inheritDoc
     */
    public function from($data)
    {
        die(var_dump($data));
    }
    
}