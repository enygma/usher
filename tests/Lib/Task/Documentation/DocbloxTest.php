<?php

namespace Lib\Task\Documentation;

class DocbloxTest extends \PHPUnit_Framework_TestCase
{
    private $_task = null;

    public function setUp()
    {
        $this->_task = new DocbloxTask();
    }
    public function tearDown()
    {
        
    }

    public function testTrial()
    {
        $test = true;
        $this->assertTrue($test);
    }
}

?>