<?php

abstract class MAB_Base{
	/**
	 * Fuel holds references to other MAB objects. It is an instance of the MAB_Fuel class. 
	 *
	 */
	protected static $fuel = null;

	/** 
	 * Whether this class may use fuel variables in local scope, like $this->item
	 *
	 */
	protected $useFuel = true;

	/**
	 * Add fuel to all classes descending from MAB_Base
	 *
	 * @param string $name 
	 * @param mixed $value 
	 * @param bool $lock Whether the API value should be locked (non-overwritable)
	 * @internal Fuel is an internal-only keyword.
	 * 	Unless static needed, use $this->MAB($name, $value) instead.
	 *
	 */
	public static function setFuel($name, $value, $lock = false) {
		if(is_null(self::$fuel)) self::$fuel = new MAB_Fuel();
		self::$fuel->set($name, $value, $lock); 
	}

	/**
	 * Get the Fuel specified by $name or NULL if it doesn't exist
	 *
	 * @param string $name
	 * @return mixed|null
	 * @internal Fuel is an internal-only keyword.  
	 * 	Use $this->MAB(name) or $this->MAB()->name instead, unless static is required.
	 *
	 */
	public static function getFuel($name = '') {
		if(empty($name)) return self::$fuel;
		return self::$fuel->$name;
	}

	/**
	 * Get or inject a MAB API variable
	 * 
	 * 1. As a getter (option 1): 
	 * ==========================
	 * Usage: $this->MAB('name'); // name is an API variable name
	 * If 'name' does not exist, a WireException will be thrown.
	 * 
	 * 2. As a getter (option 2): 
	 * ==========================
	 * Usage: $this->MAB()->name; // name is an API variable name
	 * Null will be returned if API var does not exist (no Exception thrown).
	 * 
	 * 3. As a setter: 
	 * ===============
	 * $this->MAB('name', $value); 
	 * $this->MAB('name', $value, true); // lock the API variable so nothing else can overwrite it
	 * $this->MAB()->set('name', $value); 
	 * $this->MAB()->set('name', $value, true); // lock the API variable so nothing else can overwrite it
	 * 
	 * @param string $name Name of API variable to retrieve, set, or omit to retrieve the master ProcessWire object
	 * @param null|mixed $value Value to set if using this as a setter, otherwise omit.
	 * @param bool $lock When using as a setter, specify true if you want to lock the value from future changes (default=false)
	 * @return mixed|ProcessWire
	 * @throws WireException
	 * 
	 *
	 */
	public function MAB($name = '', $value = null, $lock = false) {
		if(is_null(self::$fuel)) self::$fuel = new MAB_Fuel();
		if(!is_null($value)) return self::$fuel->set($name, $value, $lock);
		if(empty($name)) return self::$fuel->MAB;
		$value = self::$fuel->$name;
		if(is_null($value)) throw new MAB_Exception("Unknown API variable: $name"); 
		return $value;
	}

	/**
	 * Should fuel vars be scoped locally to this class instance?
	 *
	 * If so, you can do things like $this->fuelItem.
	 * If not, then you'd have to do $this->fuel('fuelItem').
	 *
	 * If you specify a value, it will set the value of useFuel to true or false. 
	 * If you don't specify a value, the current value will be returned. 
	 *
	 * Local fuel scope should be disabled in classes where it might cause any conflict with class vars. 
	 *
	 * @param bool $useFuel Optional boolean to turn it on or off. 
	 * @return bool Current value of $useFuel
	 * @internal
	 *
	 */
	public function useFuel($useFuel = null) {
		if(!is_null($useFuel)) $this->useFuel = $useFuel ? true : false; 
		return $this->useFuel;
	}

	/**
	 * Get an object property by direct reference or NULL if it doesn't exist
	 *
	 * If not overridden, this is primarily used as a shortcut for the fuel() method. 
	 * 
	 * Descending classes may have their own __get() but must pass control to this one when they can't find something.
	 *
	 * @param string $name
	 * @return mixed|null
	 *
	 */
	public function __get($name) {

		if($name == 'mab' || $name == 'fuel') return self::$fuel;
		if($name == 'className') return $this->className();
		
		if($this->useFuel()) {
			if(!is_null(self::$fuel) && !is_null(self::$fuel->$name)) return self::$fuel->$name; 
		}

		return null;
	}

	/*******************************************************************************************************
	 * IDENTIFICATION
	 *
	 */
	
	/**
	 * Cached name of this class from the className() method
	 *
	 */
	private $className = '';

	/**
	 * Return this object's class name
	 *
	 * Note that it caches the class name in the $className object property to reduce overhead from calls to get_class().
	 *
	 * @return string
	 *
	 */
	public function className() {
		if(!$this->className) $this->className = get_class($this);
		return $this->className;
	}


	/**
	 * Unless overridden, classes descending from Wire return their class name when typecast as a string
	 *
	 */
	public function __toString() {
		return $this->className();
	}


	/**
	 * Log
	 */
	public function log($log, $type = 'error'){
		MAB_Logs::log($log, $type);
	}

}