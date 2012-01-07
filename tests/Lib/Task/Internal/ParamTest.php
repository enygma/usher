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
        unset($this->_task);
    }

    /**
     * Options not found/loaded in task project data
     *
     * @expectedException Exception
     */
    public function testOptionsNotLoaded()
    {
        $this->_task->execute();
    }

    /**
     * Options are not found in task project data
     */
    public function testOptionsNotFound()
    {
        \Usher\Lib\Config::load(APPLICATION_PATH.'/');
    }
}

?>