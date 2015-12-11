<?php

namespace core\Group\Session\Tests;

use Test;
use Session;

class SessionTest extends Test
{
    public function testSet()
    {
        Session::set('group', 'good');
        $info = Session::get('group');
        $this -> assertEquals('good', $info);
        Session::clear();
    }

    public function testHas()
    {
        Session::set('group', 'good');
        $info = Session::has('group');
        $this -> assertTrue($info);
    }

    public function testClear()
    {
        Session::set('group', 'good');
        Session::clear();
        $info = Session::get('group');
        $this -> assertEquals('', $info);
    }

    public function testAll()
    {
        $info = Session::all();
        $this -> assertEmpty($info);
        Session::set('group', 'good');
        $info = Session::all();
        $this -> assertEquals(['group' => 'good'], $info);
    }

    public function testRemove()
    {
        Session::set('group', 'good');
        Session::remove('group');
        $info = Session::get('group');
        $this -> assertEquals('', $info);
    }

    public function testIsStarted()
    {
        $status = Session::isStarted();
        $this -> assertTrue($status);
    }

    public function testReplace()
    {
        Session::set('group', 'good');
        $attributes = ['group' => 'hello'];
        Session::replace($attributes);
        $this -> assertEquals($attributes['group'], Session::get('group'));
    }
}
