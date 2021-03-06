<?php

require_once __DIR__ . '/../src/com/syamgot/php/validator/utils/ValidatorTemplates.php';

use com\syamgot\php\validator\utils\ValidatorTemplates;


/**
 * 
 * 
 *  
 * @author syamgot
 */
class ValidatorTemplatesTest extends PHPUnit_Framework_TestCase {
	
	/** **************************************************
	*
	* Tests
	*
	************************************************** */
    
	/**
	 * @dataProvider providerInt
	 */
	public function testInt($val, $res) {
		$v = ValidatorTemplates::int();
		$this->assertEquals($v->isValid($val), $res);
	}

	/**
	 * @dataProvider providerIntNotEmpty
	 */
	public function testIntNotEmpty($val, $res) {
		$v = ValidatorTemplates::intNotEmpty();
		$this->assertEquals($v->isValid($val), $res);
	}

	/**
	 * @dataProvider providerString
	 */
	public function testString($val, $res) {
		$v = ValidatorTemplates::string();
		$this->assertEquals($v->isValid($val), $res);
	}
	
	/** **************************************************
	*
	* setup and teardown
	*
	************************************************** */
	
	/**
	 * 
	 */	
	public static function setUpBeforeClass() {}
	
	/**
	 *
	 */
	protected function setUp() {}
	
	/**
	 * 
	 */
	protected function tearDown() {}
	
	/**
	 * 
	 */
	public static function tearDownAfterClass() {}
	
	
	/** **************************************************
	*
	* Static Methods
	*
	************************************************** */
	
	/**
	 * @var Validator
	 */
	protected static $obj;
	
	
	/** **************************************************
	 * 
	 * Data Providers
	 * 
	 ************************************************** */
	
    /**
     * 
     */
    public function providerInt() {
    	return array(
	    	  array(0, 				true)
	    	, array(10,		 		true)
	    	, array('hoge', 		false)
	    	, array(100.01, 		false)
	    	, array(array('hoge'), 	false)
	    	, array(true, 			false)
	    	, array(null, 			false)
    	);
    }

    /**
     * 
     */
    public function providerIntNotEmpty() {
    	return array(
	    	  array(0, 				false)
	    	, array(10,		 		true)
	    	, array('hoge', 		false)
	    	, array(100.01, 		false)
	    	, array(array('hoge'), 	false)
	    	, array(true, 			false)
	    	, array(null, 			false)
    	);
    }

    /**
     * 
     */
    public function providerString() {
    	return array(
	    	  array(0, 				false)
	    	, array('hoge', 		true)
	    	, array(100.01, 		false)
	    	, array(array('hoge'), 	false)
	    	, array(true, 			false)
	    	, array(null, 			false)
    	);
    }

    /**
     * 
     */
    public function providerStringNotEmpty() {
    	return array(
	    	  array(0, 				false)
	    	, array('hoge', 		false)
	    	, array('', 			true)
	    	, array(100.01, 		false)
	    	, array(array('hoge'), 	false)
	    	, array(true, 			false)
	    	, array(null, 			false)
    	);
    }

    /**
     * $min, $max, $val, $res
     */
    public function providerLimitedInt() {
    	return array(
	    	  array(0,	2,	1,	true)
	    	, array(0,	2,	-1,	false)
	    	, array(0,	2,	3,	false)
    	);
    }

}

