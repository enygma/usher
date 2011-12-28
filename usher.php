<?php
/**
 * Usher.php
 *
 * PHP Version 5
 *
 * Main runner - loads configuration, finds and executes tasks
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher;

require_once 'Lib/Loader.php';

ob_start();
try {
    Lib\Loader::init();
    Lib\Console::init();
    Lib\Config::load();
}catch(\Exception $e){
    Lib\Console\Output::msg('Error on setup: '.$e->getMessage());
    die();
}

$projectName = Lib\Config::getOption('project.name');
Lib\Console\Output::msg('Executing project "'.$projectName.'"');

// get and execute our tasks
try {
    $app = new Lib\Application();
    $app->execute();
}catch(\Exception $e){
    Lib\Console\Output::error('Error on build! ('.$e->getMessage().')');
}

if (Lib\Console::getOption('logFile') !== null) {
    $output = ob_get_contents();
    Lib\Utility\Logger::write($output);
}

if (Lib\Console::getOption('runQuiet') == true) {
    ob_end_clean();
}

?>
