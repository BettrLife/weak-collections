<?php

namespace WeakCollections;
use ArrayAccess, WeakRef;

/** Implements an array of key => value pairs where the value is always a weak
    reference in the array.  In other words, this is an array you can stick
    things in without forcing those objects to stay alive.  If the object
    becomes invalid, so too does the key.

    Use this for things like keeping a cache of database objects, so if two
    things ask for the same ID, you can give them the same object.

    Contrast this with WeakMap, which takes weakly-referenced keys. */
class WeakArray implements ArrayAccess {
	protected $_ = [];

	function offsetExists($k) {
		if (!isset($this->_[$k])) return false;
		if ($this->_[$k]->valid()) return true;
		unset($this->_[$k]);
		return false;
	}

	function offsetGet($k) {
		return $this->_[$k]->get();
	}

	function offsetSet($k, $v) {
		$this->_[$k] = new WeakRef($v);
	}

	function offsetUnset($k) {
		unset($this->_[$k]);
	}
}
