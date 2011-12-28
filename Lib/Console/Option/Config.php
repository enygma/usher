<?php
/**
 * Config option
 *
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Console\Option;

/**
 * Class Config
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 * @description Set the path to the config.json file
 */
class Config extends \Usher\Lib\Console\Option
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
        // if the config file is valid set it
        $configFilePath = (isset($argumentData[1])) ? $argumentData[1] : null;

        if ($configFilePath !== null && is_file($configFilePath)) {
            \Usher\Lib\Console::setOption('configFilePath', $configFilePath);
        } else {
            throw new \RuntimeException(
                'Could not set configuration: "'.$configFilePath.'"'
            );
        }
        return true;
    }
}

?>