<?php

namespace Usher\Lib\Task\Internal;

class WriteTask extends \Usher\Lib\Task
{
    public function execute()
    {
        //echo out the string given in the parameter
        $message = $this->getOption('message');
        \Usher\Lib\Console\Output::msg($message);       
    }
}

?>
