<?php
/**
 * Abstract definiton of a command-line option
 *
 * PHP Version 5
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Console;

/**
 * Class Option
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
abstract class Option
{
    /**
     * Execute the given option
     *
     * @param array $argumentData Argument data
     *
     * @return bool Stop/Not stop execution
     */
    public abstract function execute($argumentData);
}

?>