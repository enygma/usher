<?php
/**
 * Main application handling class
 *
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib;

/**
 * Class Application
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class Application
{
    /**
     * Set the current working directory
     *
     * @return void
     */
    private function _setWorkingDir()
    {
        Utility\SessionManage::set('workingDir', str_replace('/Lib', '', __DIR__));
    }

    /**
     * Execute the build
     *
     * @return void
     * @throws Exception
     */
    public function execute()
    {
        $this->_setWorkingDir();
        
        foreach ($this->getTasks() as $task) {
            try {
                Console\Output::msg('Executing task: '.$task->configuration->type);

                if (method_exists($task, 'init')) {
                    $task->init();
                }
                $task->execute();
            }catch(\Exception $e){
                //$failureMessages[$task->configuration->id][] = $e->getMessage();
                throw new \Exception('Application error: '.$e->getMessage());
            }
        }
    }

    /**
     * Get the list of current tasks and transform them into 
     * the corresponding classes
     *
     * @return array $taskObjects Objects made from task data
     */
    public function getTasks()
    {
        // pull them from the config file and make them classes
        $tasks       = Config::getOption('project.tasks');
        $project     = Config::getOption('project');
        $taskObjects = array();

        foreach ($tasks as $index => $task) {

            $typeParts = explode('.', $task->type);
            $typePath  = '';
            foreach ($typeParts as $part) {
                $typePath .= ucwords(strtolower($part)).'\\';
            }
            $typePath = substr($typePath, 0, strlen($typePath)-1);
            
            //$taskName       = '\Usher\\Lib\\Task\\'.$typePath;
            $taskName       = '\\Lib\\Task\\'.$typePath;
            $className      = $taskName.'Task';
            $taskObject     = new $className($project);
            $task->id = $index;
            $taskObject->configure($task);

            $taskObjects[]  = $taskObject;
        }
        return $taskObjects;
    }
}

?>
