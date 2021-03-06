<?php

namespace com\syamgot\php\validator {
	
	/**
	 * 
	 * バリデートクラスのインターフェイスです
	 * 
	 * @package validator
	 * @author syamgot
	 */
	interface IValidator {
		
		/**
		 * 
		 * 引数が有効かどうかを返します。
		 * 
		 * @param mixed $val
		 * @return boolean
		 */
		public function isValid($val);
		
	}
	
}

