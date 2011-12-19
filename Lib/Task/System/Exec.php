<?php

namespace Lib\Task\System;

/**
 * Used to run a given command
 * 
 * @package usher
 */
class ExecTask extends \Lib\Task
{
    public function execute()
    {
        $command = $this->getOption('command');
        try {
            \Lib\Console\Execute::run($command);
        }catch(\Exception $e){
            throw new \Exception('Error on command: '.$e->getMessage());
        }
    }

}

?>
