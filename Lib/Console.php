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
     * Set an option in the console namespace
     *
     * @param string $optionName Option name
     * @param mixed  $value      Option value
     *
     * @return void
     */
    public function setOption($optionName,$value)
    {
        return \Usher\Lib\Utility\SessionManage::set($optionName, $value, 'console');
    }

    /**
     * Get the console option from the session
     *
     * @param string $optionName Name of the option to get
     * 
     * @return mixed Option value
     */
    public function getOption($optionName)
    {
        return \Usher\Lib\Utility\SessionManage::get($optionName, 'console');
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
            // remove the "-" or "--", but only at the beginning
            $argument   = preg_replace('/^\-+/', '', $argument);

            // split off the key/value
            $parts      = explode('=', $argument);
            $argument   = (!is_array($parts)) ? array($parts) : $parts;

            // see if we have a class to match it
            $nsPath = '\\Usher\\Lib\\Console\\Option\\'.
                ucwords(strtolower($argument[0]));

            try {
                try {
                    $stopExecution = $nsPath::execute($argument);
                    if ($stopExecution == false) {
                        die();
                    }
                } catch(\RuntimeException $re) {
                    \Usher\Lib\Console\Output::msg($re->getMessage());
                }
            } catch(\Exception $e) {
                // can't find the argument class
                \Usher\Lib\Console\Output::msg(
                    'Option "'.$argument[0].'" not found.'
                );
            }
        }
    }
}

?>
