<?php
/**
 * "Build Composer file" ption
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
 * Class Buildcomposer
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 * @description Help option (display this info)
 */
class Buildcomposer extends \Usher\Lib\Console\Option
{
    /**
     * Default configuration file name
     * @var string
     */
    private static $_configFile = 'composer.json';

    /**
     * Execute the Help option
     *
     * @param array $argumentData Argument data
     *
     * @return bool Stop/Don't stop execution
     */
    public function execute($argumentData)
    {
        \Usher\Lib\Config::load();
        $project        = \Usher\Lib\Config::getOption('project');
        $task           = new \Usher\Lib\Task\Internal\BaseTask($project);
        $config         = $task->getProjectOption('composerConfig');

        if ($config === null) {
            throw new \RuntimeException(
                'Composer configuration not found in config.json'
            );
        }

        $config->name   = $task->getProjectOption('name');
        $currentDir     = getcwd();
        $configString   
            = \Usher\Lib\Utility\JsonHandler::output(json_encode($config));

        // find our project path and see if we have a composer.json already
        $projectBase  = $task->getProjectOption('projectBase');

        if (is_dir($projectBase)) {
            //let's make ourselves a config file!
            chdir($projectBase);
            file_put_contents(self::$_configFile, $configString);
            chdir($currentDir);
        } else {
            throw new \RuntimeException(
                'Cound not determine project base directory'
            );
        }

        return true;
    }
}

?>
