<?php
 /**
 * Perform a "git clone" on the given repository
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Lib\Task\Vcs\Git;

 /**
 * Class CloneTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class CloneTask extends \Usher\Lib\Task
{
    /**
     * Execute the task
     *
     * @throws Exception
     * @return void
     */
    public function execute()
    {
        $repositoryPath  = $this->getOption('repositoryPath');
        $destinationPath = $this->getOption('destinationPath'); 

        if ($repositoryPath == null) {
            throw new \Exception('Repository path not set! (repoPath)');
        }
        if ($destinationPath == null) {
            throw new \Exception('Destination path not set! (destinationPath)');
        }

        $exec = 'git clone '.$repositoryPath.' '.$destinationPath;
        $args = array('clone', $repositoryPath, $destinationPath);

        \Usher\Lib\Console\Execute::run($exec, $args);
    }

}


?>
