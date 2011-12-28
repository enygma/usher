<?php
/**
 * Handling for the default configuration file
 *
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib;

/**
 * Class Config
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class Config
{
    /**
     * Filename for the default config file
     * @var string
     */
    private static $_configFile      = 'config.json';

    /**
     * Current configuration options
     * @var array
     */
    private static $_currentConfig   = null;

    /**
     * Load the configuration from the given file
     *
     * @throws Exception
     * @return void
     */
    public static function load()
    {
        // look for a configuration file
        $configFilePath = self::$_configFile;

        // see if we have a config file option on the command line
        $path = \Usher\Lib\Console::getOption('configFilePath');
        if ($path !== null) {
            $configFilePath = $path;
        }

        if (is_file($configFilePath)) {
            self::$_currentConfig = json_decode(file_get_contents($configFilePath));
            if (self::$_currentConfig == null) {
                throw new \Exception(
                    'Error parsing configuration file "'.self::$_configFile.'"!'
                );
            }
        } else {
            throw new \Exception('No config file found!');
        }
    }

    /**
     * Get an option from the configuration file
     *
     * @param string $optionPath Option path to find
     *
     * @return Option value (or null)
     */
    public function getOption($optionPath)
    {
        $ex = new Utility\ExpandObject();
        return $ex->find(self::$_currentConfig, $optionPath, '.');
    }
}

?>
