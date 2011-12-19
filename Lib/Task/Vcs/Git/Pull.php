<?php
 /**
 * Perform a "git pull" on the given repository
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Task\Vcs\Git;

/**
 * Class PullTask
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class PullTask extends \Usher\Lib\Task
{
    /**
     * Default "git pull" command
     */
    private $_command = 'git pull';
    
    /**
     * Execute the task
     *
     * @return void
     */
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