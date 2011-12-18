<?php

namespace Lib\Task\Syntax;

/**
 * Runs a php lint check on the project directory
 * 
 * @package usher
 */
class PhpLintTask extends \Lib\Task
{
    
    public function execute()
    {
        // get the project basedir
        $projectDir = $this->getProjectOption('projectBase');

        if($projectDir != null && is_dir($projectDir)){
            $exec = 'php -l '.$projectDir;
            \Lib\Console\Execute::run($exec);
        }else{
            throw new \Exception('Could not determine project directory (projectBase)');
        }
        
    }

}

?>
