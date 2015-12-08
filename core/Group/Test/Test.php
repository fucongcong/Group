<?php

namespace core\Group\Test;

use PHPUnit_Framework_TestCase;

class Test extends PHPUnit_Framework_TestCase
{
    public function testAction()
    {
        $this -> assertEquals('group', 'group');
    }
}
