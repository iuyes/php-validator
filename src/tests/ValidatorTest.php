<?php

require_once __DIR__ . '/../validator/Validator.php';
require_once __DIR__ . '/../validator/AlumValidator.php';
require_once __DIR__ . '/../validator/DataTypeValidator.php';
require_once __DIR__ . '/../validator/GEValidator.php';
require_once __DIR__ . '/../validator/GTValidator.php';
require_once __DIR__ . '/../validator/LEValidator.php';
require_once __DIR__ . '/../validator/LTValidator.php';
require_once __DIR__ . '/../validator/NotEmptyValidator.php';
require_once __DIR__ . '/../validator/NotNullValidator.php';
require_once __DIR__ . '/../validator/StrLEngthValidator.php';

/**
 * 
 * 
 *  
 * @author syamgot
 */
class validatorTest extends PHPUnit_Framework_TestCase {
	
	/** **************************************************
	*
	* Tests
	*
	************************************************** */
    
	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($Validators, $val, $res) {
		$v = new Validator();
		foreach($Validators as $key => $value) {
			$v->addValidator($Validators[$key]);
		}
		$this->assertEquals($v->isValid($val), $res);
	}

	/**
	 * 
	 * Enter description here ...
	 */
	public function testAddValidatorException() {
		try {
			$v = new Validator();
			$v->addValidator(new stdClass());
		} catch (InvalidArgumentException $e) {
			return;
		}
		$this->fail('期待通りの例外が発生しませんでした。');
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function testGetValidator() {
		$v = new Validator();
		$this->assertNull($v->getValidator('Alum'));
		$v->addValidator(new AlumValidator());
		$this->assertNotNull($v->getValidator('Alum'));
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
     * $Validators, $value, $res
     * 
     * @return array
     */
    public function providerIsValid() {
    	return array(
    		
    		// クラスを生成して追加するパターン
    		  array(array(
    				  new StrLEngthValidator(array('min' => 5, 'max' => 10, 'charset' => 'utf-8'))
    				, new AlumValidator()
    			), 'abcde12345', true)
    		, array(array(
    				  new StrLEngthValidator(array('min' => 5, 'max' => 10, 'charset' => 'utf-8'))
    				, new AlumValidator()
    			), 'abcde12***', false)
	    	, array(array(
			    	  new StrLEngthValidator(array('min' => 5, 'max' => 10, 'charset' => 'utf-8'))
			    	, new AlumValidator()
		    	), 'abcde12あいう', false)
		    
    		, array(array(
			    	  new GEValidator(array('min' => 0))
			    	, new LEValidator(array('max' => 1))
		    	), 0, true)
    		, array(array(
			    	  new GEValidator(array('min' => 0))
			    	, new LEValidator(array('max' => 1))
		    	), 1, true)
    		, array(array(
			    	  new GEValidator(array('min' => 0))
			    	, new LEValidator(array('max' => 1))
		    	), 2, false)
	    	, array(array(
			    	  new GEValidator(array('min' => 0))
			    	, new LEValidator(array('max' => 1))
		    	), -1, false)
		    
		    // 名前を指定して追加するパターン
    		, array(array(
	    			  array('name' => 'StrLEngth', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
		    	), 'abcde12345', true)
	    	, array(array(
	    			  array('name' => 'StrLEngth', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
		    	), 'abcde12***', false)
	    	, array(array(
	    			  array('name' => 'StrLEngth', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
		    	), 'abcde12あいう', false)
		    	
	    	, array(array(
	    			  array('name' => 'GE', 'min' => 0)
			    	, array('name' => 'LE', 'max' => 1)
		    	), 0, true)
	    	, array(array(
	    			  array('name' => 'GE', 'min' => 0)
			    	, array('name' => 'LE', 'max' => 1)
		    	), 1, true)
	    	, array(array(
	    			  array('name' => 'GE', 'min' => 0)
			    	, array('name' => 'LE', 'max' => 1)
		    	), 2, false)
    		, array(array(
    				  array('name' => 'GE', 'min' => 0)
			    	, array('name' => 'LE', 'max' => 1)
    			), -1, false)
    			
	    	, array(array(
	    			  array('name' => 'RegularExpression', 'pattern' => "/^[0-9a-z]+$/")
		    	), '000aaaa', true)
    	);
    }

}
