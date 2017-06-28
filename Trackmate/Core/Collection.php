<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Core;
use \Iterator;

class Collection implements Iterator
{
	protected $items;
	
	public function __construct()
	{
		$this->items = [];
	}
	
	public function add($identifier, $item, $params = [])
	{
		die(var_dump($identifier, $item, $params));
		$this->items[$identifier] = [
			"class" => $item,
			"deps" => $params
		];
	}
	
	public function remove($identifier)
	{
		unset($this->items[$identifier]);
	}
	
	public function get($identifier)
	{
		$class = $this->items[$identifier];
		$object = $class["class"];
		$deps = $class["deps"];
		
		$deps = explode(",", $deps);
		
		if( !is_null($deps) ){
			return new $object($deps);
		}
		
		return new $object();
	}
	
	public function has($identifier)
	{
		return isset($this->items[$identifier]);
	}
	
	public function current()
	{
		// TODO: Implement current() method.
	}
	
	public function next()
	{
		// TODO: Implement next() method.
	}
	
	public function key()
	{
		// TODO: Implement key() method.
	}
	
	public function valid()
	{
		// TODO: Implement valid() method.
	}
	
	public function rewind()
	{
		// TODO: Implement rewind() method.
	}
	
	
}