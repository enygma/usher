<?php

namespace Usher\Lib\Task\Vcs\Git;

class PullTask extends \Usher\Lib\Task
{
    
    public function execute()
    {
        $this->getOption('repositoryPath');
        
    }

}


?>