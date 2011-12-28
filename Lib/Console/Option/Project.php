<?php
/**
 * Project Select option
 *
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Bob Majdak Jr <bob@opsat.net>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Console\Option;

/**
 * Class Project
 *
 * @category Build
 * @package  Usher
 * @author   Bob Majdak Jr <bob@opsat.net>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 * @description Allow you to select a specific project from a config file with many.
 */
class Project extends \Usher\Lib\Console\Option
{
    /**
     * Execute the Project Selection
     *
     * @param array $argumentData Argument data
     *
     * @return bool Stop/Don't stop execution
     */
    public function execute($argumentData)
    {
        if (count($argumentData) != 2) {
            throw new \RuntimeException('Project argument requires a project name.');
            return false;
        }
        
        \Usher\Lib\Console::setOption('selectedProject', $argumentData[1]);
        return true;
    }
}

?>