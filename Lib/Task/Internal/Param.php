<?php

namespace Lib\Task\Internal;

class ParamTask extends \Lib\Task
{
        public function execute()
        {
		//set up a valirable internal to the scope of the execution	
		$value = $this->getOption('value');
		$name  = $this->getOption('name');
	}
}

?>
