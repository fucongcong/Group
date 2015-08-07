<?php
namespace core\Group\Exceptions;

use Exception;
use core\Group\Contracts\Exceptions\Exception as ExceptionContract;

class NotFoundException extends Exception implements ExceptionContract
{
	// 重定义构造器使 message 变为必须被指定的属性
	public function __construct($message, $code = 0) {
	    // 自定义的代码

	    // 确保所有变量都被正确赋值
    		parent::__construct($message, $code);
	}

    /**
    * Custom pattern string output
    *
    * @return exception message
    */
	public function __toString()
	{
    		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}

}
