<?php

namespace Usher\Lib\Task\File;

/**
 * File move task
 * 
 * Configuration parameters:
 * "source" : File path to use as a source
 * "target" : File path to move the file(s) to
 *
 * @package Usher
 */
class MoveTask extends \Usher\Lib\Task
{
    public function execute()
    {
        $sourcePath = $this->getOption('source');
        $targetPath = $this->getOption('target');

        if($sourcePath != null && $targetPath != null && is_file($sourcePath)){

            $command = 'mv '.$sourcePath.' '.$targetPath;
            \Usher\Lib\Console\Execute::run($command);

        }elseif(!is_file($sourcePath)){
            throw new \Exception('Source file "'.$sourcePath.'" not found');
        }
    }   
}

?>