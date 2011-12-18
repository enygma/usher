<?php

namespace Usher\Lib\Task\Internal;

class ParamTask extends \Usher\Lib\Task
{
    public function execute()
    {
		//set up a valirable internal to the scope of the execution	
		$value = $this->getOption('value');
		$name  = $this->getOption('name');

		\Usher\Lib\Utility\SessionManage::set($name,$value);
	}
}

?>
