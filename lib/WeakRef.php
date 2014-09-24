<?php

/** A compatibility shim, ensuring that those without the PECL weakref extension
    loaded will still function, if perhaps not quite as memory-efficiently. */
class WeakRef {
	protected $ob;

	function __construct($ob) {
		if (is_object($ob)) {
			$this->ob = $ob;
		}
		else {
			trigger_error("WeakRef::__construct() expects parameter 1 to be object, ".gettype($ob)." given", E_USER_WARNING);
		}
	}

	function acquire() { return isset($this->ob); }
	function release() { return isset($this->ob); }

	function valid() { return isset($this->ob); }

	function get() { return $this->ob; }
}
