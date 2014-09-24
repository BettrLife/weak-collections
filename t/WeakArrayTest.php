<?php

namespace WeakCollections;
use PHPUnit_Framework_TestCase, StdClass;

class WeakArrayTest extends PHPUnit_Framework_TestCase {
	public function testCanInsert() {
		$o = new StdClass();
		$a = new WeakArray();
		$a['o'] = $o;
		$this->assertEquals($o, $a['o']);
	}

	public function testCanRemove() {
		$o = new StdClass();
		$a = new WeakArray();
		$a['o'] = $o;
		unset($a['o']);
		$this->assertFalse(isset($a['o']));
	}

	public function testDiesWithOriginalObject() {
		if (!extension_loaded('weakref')) {
			$this->markTestSkipped("WeakRef extension not available");
		}
		$o = new StdClass();
		$a = new WeakArray();
		$a['o'] = $o;
		unset($o);
		$this->assertFalse(isset($a['o']));
	}
}
