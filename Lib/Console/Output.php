<?php
/**
 * Standard output class
 *
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Console;

/**
 * Class Output
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class Output
{
    /**
     * Output a formatted "message" to the console
     *
     * @param string $message Message to print
     *
     * @return void
     */
    public static function msg($message)
    {
        echo Output\Color::decorate('msg', $message);
    }

    /**
     * Output a formatted "error" to the console
     *
     * @param string $message   Message to print
     * @param string $errorType Error type, defaults to "GENERAL"
     *
     * @return void
     */
    public static function error($message,$errorType='GENERAL')
    {
        echo Output\Color::decorate('error', array($errorType, $message));
    }
}

?>
