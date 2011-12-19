<?php
 /**
 * Move file(s) from one place to another
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
namespace Usher\Lib\Task\File;

/**
 * Class CopyTask
 *
 * * Configuration parameters:
 * "source" : File path to use as a source
 * "target" : File path to copy the file(s) to
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class CopyTask extends \Usher\Lib\Task
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

        if ($sourcePath != null && $targetPath != null && is_file($sourcePath)) {
            copy($sourcePath, $targetPath);
        } elseif (!is_file($sourcePath)) {
            throw new \Exception('Source file "'.$sourcePath.'" not found');
        }
    }   
}

?>