<?php
/**
 * Generic console handling class
 *
 * PHP Version 5
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib;

/**
 * Class Console
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class Console
{
    /**
     * Initialize the console with it's arguments
     *
     * @return void
     */
    public static function init()
    {
        self::_parseArguments();

        // if the help option is given, output the full list of options
    }

    /**
     * Parse the current options given on the command line
     *
     * @return void
     */
    private static function _parseArguments()
    {
        $args = $_SERVER['argv'];

        // go through our options and see if any of them are defined
        // remove the first since it's the script's name
        $arguments = (isset($_SERVER['argv']) && !empty($_SERVER['argv'])) 
            ? array_slice($_SERVER['argv'], 1, count($_SERVER['argv'])-1) : array();

        foreach ($arguments as $argument) {
            // remove the "-" or "--"
            $argument   = str_replace(array('-', '--'), '', $argument);

            // split off the key/value
            $parts      = explode('=', $argument);
            $argument   = (!is_array($parts)) ? array($parts) : $parts;

            // see if we have a class to match it
            $nsPath = '\\Usher\\Lib\\Console\\Option\\'.
                ucwords(strtolower($argument[0]));

            try {
                $stopExecution = $nsPath::execute();
                if ($stopExecution == false) {
                    die();
                }
            } catch(\Exception $e) {
                echo $e->getMessage();
                \Usher\Lib\Console\Output::msg(
                    'Option "'.$argument[0].'" not found.'
                );
            }
        }
    }
}

?>
