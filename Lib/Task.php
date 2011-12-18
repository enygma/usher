<?php

namespace Usher\Lib;

/**
 * Abstract definition of a Task
 *
 * @package Usher
 */
abstract class Task
{
	/**
	 * Current pass/fail status
	 * @var bool
	 */
	public $passStatus = true;

	/**
	 * Task configuration settings (as pulled from config file)
	 * @var array
	 */
	public $configuration = array();

	/**
	 * Configuration settings for the current project
	 * @var array
	 */
	public $parentProject = null;

	public function __construct($project)
	{
		$this->parentProject = $project;	
	}

	/**
	 * Assign configuration data for task object
	 *
	 * @param array $configData Configuration data
	 * @return void
	 */
	public function configure($configData)
	{
		$this->configuration = $configData;
	}

	/**
	 * Get the value of a current configuration object
	 *
	 * @param string $optionName Option name/path
	 * @return mixed Option value
	 */
	public function getOption($optionName)
	{
		if(isset($this->configuration->$optionName)){
			if(gettype($this->configuration->$optionName) == 'string' && 
				stristr($this->configuration->$optionName,'param:') != false){
					$optionName = str_replace('param:','',$this->configuration->$optionName);
					return \Usher\Lib\Utility\SessionManage::get($optionName);
			}else{
				return $this->configuration->$optionName;
			}
		}else{
			return null;
		}
	}

	public function getProjectOption($optionName)
	{
		return (isset($this->parentProject->$optionName))
			? $this->parentProject->$optionName : null;
	}

	/**
	 * Abstract definiton of main execution method
	 * @return void
	 */
	public abstract function execute();
}

?>