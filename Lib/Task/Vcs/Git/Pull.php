<?php

namespace Usher\Lib\Task\Vcs\Git;

/**
 * Task executing a "pull" request on a git repository
 */
class PullTask extends \Usher\Lib\Task
{
    /**
     * Default "git pull" command
     */
    private $_command = 'git pull';
    
    public function execute()
    {
        $destinationPath = $this->getOption('destinationPath'); 
        $currentDir      = getcwd();
        
        // change to the destination directory
        chdir($destinationPath);

        \Usher\Lib\Console\Execute::run($this->_command);

        // change back to our working directory
        chdir($currentDir);
    }

}


?>