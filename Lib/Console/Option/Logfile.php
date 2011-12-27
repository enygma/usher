<?php
/**
 * Quiet option
 *
 * PHP Version 5
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Console\Option;

/**
 * Class Quiet
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 * @description Help option (display this info)
 */
class Logfile extends \Usher\Lib\Console\Option
{
    /**
     * Execute the Help option
     *
     * @param array $argumentData Argument data
     *
     * @return bool Stop/Don't stop execution
     */
    public function execute($argumentData)
    {
        \Usher\Lib\Console::setOption('logFile', $argumentData[1]);
        return true;
    }
}

?>