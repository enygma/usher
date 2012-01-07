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
     * Whole configuration (all projects included)
     * @var array
     */
    private static $_wholeConfig     = null;

    /**
     * Load the configuration from the given file
     *
     * @throws Exception
     * @return void
     */
    public static function load($configPath=null)
    {
        // look for a configuration file
        $configFilePath = (($configPath !== null) ? $configPath : '').self::$_configFile;

        // see if we have a config file option on the command line
        $path = \Usher\Lib\Console::getOption('configFilePath');
        if ($path !== null) {
            $configFilePath = $path;
        }

        if (is_file($configFilePath)) {
            self::$_currentConfig 
                = self::$_wholeConfig 
                    = json_decode(file_get_contents($configFilePath));
            if (self::$_currentConfig == null) {
                throw new \Exception(
                    'Error parsing configuration file "'.self::$_configFile.'"!'
                );
            }
            
            if (is_array(self::$_currentConfig)) {
                self::$_currentConfig = false;
                
                $project = \Usher\Lib\Console::getOption('selectedProject');
                if (!$project) {
                    throw new \Exception("No project was selected.");
                }
                
                foreach (self::$_wholeConfig as $conf) {
                    if ($conf->project->name == $project) {
                        self::$_currentConfig = $conf;
                        break;
                    }
                }
                
                if (!self::$_currentConfig) {
                    throw new \Exception(
                        "No project named {$project} in config file."
                    );
                }
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

    /**
     * Set the path to the configuration file
     *
     * @param string $configPath Path to directory containing configuration file
     *
     * @return void
     */
    public function setConfigFilePath($configPath)
    {
        $this->_configFile = $configPath.'/'.$this->_configFile;
    }
}

?>
