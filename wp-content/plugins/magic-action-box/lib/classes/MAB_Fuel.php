<?php

/**
 * Based off ProcessWire Fuel class http://processwire.com
 */
class MAB_Fuel implements IteratorAggregate {

	protected $data = array();
	protected $lock = array();

	/**
	 * @param string $key API variable name to set - should be valid PHP variable name.
	 * @param object|mixed $value Value for the API variable.
	 * @param bool $lock Whether to prevent this API variable from being overwritten in the future.
	 * @return $this
	 * @throws MAB_Exception When you try to set a previously locked API variable, a WireException will be thrown.
	 * 
	 */
	public function set($key, $value, $lock = false) {
		if(in_array($key, $this->lock) && $value !== $this->data[$key]) {
			throw new MAB_Exception("API variable '$name' is locked and may not be set again"); 
		}
		$this->data[$key] = $value; 
		if($lock) $this->lock[] = $key;
		return $this;
	}

	/**
	 * Remove an API variable from the Fuel
	 * 
	 * @param $key
	 * @return bool Returns true on success
	 * 
	 */
	public function remove($key) {
		if(isset($this->data[$key])) {
			unset($this->data[$key]);
			return true;
		}
		return false;
	}

	public function __get($key) {
		return isset($this->data[$key]) ? $this->data[$key] : null;
	}

	public function getIterator() {
		return new ArrayObject($this->data); 
	}

	public function getArray() {
		return $this->data; 
	}
}
