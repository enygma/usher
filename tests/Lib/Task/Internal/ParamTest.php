<?php

namespace Lib\Task\Internal;

class ParamTest extends \PHPUnit_Framework_TestCase
{
    private $_task = null;

    public function setUp()
    {
        $project = array();
        $this->_task = new ParamTask($project);
    }
    public function tearDown()
    {
        
    }

    /**
     * Options not found in task project data
     *
     * @expectedException Exception
     */
    public function testOptionsNotFound()
    {
        $this->_task->execute();
    }
}

?>