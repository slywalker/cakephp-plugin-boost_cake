<?php
class AllBoostCakeTest extends CakeTestSuite {

/**
 * Adds all tests to the AllBoostCakeTest case
 *
 * @return CakeTestSuite
 */
	public static function suite() {
		$suite = new CakeTestSuite('All tests');
		$path = dirname(__FILE__);
		$suite->addTestDirectory($path . DS . 'View' . DS . 'Helper');
		return $suite;
	}

}
