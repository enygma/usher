<?php

namespace Lib\Task\Internal;

class WriteTask extends \Lib\Task
{
    public function execute()
    {
		//echo out the string given in the parameter
		$message = $this->getOption('message');
		\Lib\Console\Output::msg($message);		
	}
}

?>
