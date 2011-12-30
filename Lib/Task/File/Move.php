<?php
 /**
 * Move file(s) from one place to another
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Task\File;

/**
 * Class MoveTask
 *
 * Configuration parameters:
 * "source" : File path to use as a source
 * "target" : File path to move the file(s) to
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class MoveTask extends \Usher\Lib\Task
{
    /**
     * Execute the task
     *
     * @throws Exception
     * @return void
     */
    public function execute()
    {
        $sourcePath = $this->getOption('source');
        $targetPath = $this->getOption('target');

        if ($sourcePath !== null && $targetPath !== null) {
            throw new \Exception('Source or target not found in move task');
        }

        if (is_file($sourcePath)) {
            $command = 'mv '.$sourcePath.' '.$targetPath;
            \Usher\Lib\Console\Execute::run($command);
        } elseif (!is_file($sourcePath)) {
            throw new \Exception('Source file "'.$sourcePath.'" not found');
        }
    }   
}

?>
