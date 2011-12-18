<?php

namespace Usher\Lib\Task\Vcs\Git;

/**
 * Clone a git repository from a remote source
 *
 */
class CloneTask extends \Usher\Lib\Task
{
    public function execute()
    {
        $repositoryPath  = $this->getOption('repositoryPath');
        $destinationPath = $this->getOption('destinationPath'); 

        if($repositoryPath == null){
            throw new \Exception('Repository path not set! (repoPath)');
        }
        if($destinationPath == null){
            throw new \Exception('Destination path not set! (destinationPath)');
        }

        $exec = 'git clone '.$repositoryPath.' '.$destinationPath;
        \Usher\Lib\Console\Execute::run($exec);
    }

}


?>
