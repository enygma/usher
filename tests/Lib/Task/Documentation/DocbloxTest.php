<?php

namespace Lib\Task\Documentation;

class DocbloxTest extends \PHPUnit_Framework_TestCase
{
    private $_task = null;

    public function setUp()
    {
        $project = array();
        $this->_task = new DocbloxTask($project);
    }
    public function tearDown()
    {
        unset($this->_task);
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