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
		$o = new StdClass();
		$a = new WeakArray();
		$a['o'] = $o;
		unset($o);
		$this->assertFalse(isset($a['o']));
	}

	public function testAppend() {
		$o = new StdClass();
		$a = new WeakArray();
		$a[] = $o;
		$a[] = $o;
		$this->assertEquals($a[0], $a[1]);
	}
}
