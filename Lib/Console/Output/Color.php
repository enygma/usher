<?php
/**
 * Handle the color formatting of the console output
 *
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Console\Output;

/**
 * Class Color
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class Color
{
    /**
     * Message types with their default format/color set
     * @var array
     */
    private static $_colorSet = array(
        //'error'  => "\n\033[41m> ERROR: \033[01;30;40m (%s)\033[40;31m %s\n\n",
        'error'  => "\033[41m%s ERROR: \033[40;31m (%s)\033[40;31m %s\n\n",
        'msg'    => "\033[33m%s %s\n\n",
        'notice' => "\033[33m%s %s\n\n",
        'reset'  => "\033[0m"
    );

    /**
     * Decorate a message according to its type
     * 
     * @param string $messageType Type of message
     * @param mixed  $data        String or array of data to inject into the message
     *
     * @return void
     */
    public static function decorate($messageType,$data)
    {
        if (!is_array($data)) {
            $data = array($data); 
        }
        array_unshift($data, '['.date('m.d.Y H:i:s').']');
        return 
            vsprintf(self::$_colorSet[$messageType], $data).
            self::$_colorSet['reset'];
    }
}

?>
