<?php

namespace Lib\Task\Internal;

class Echo extends \Lib\Task
{
        public function execute()
        {
		//echo out the string given in the parameter
		$message = $this->getOption('message');
		Console\Output::msg($message);
		
	}
}

?>
