<?php
/**
 * Generic logging utility
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Utility;

/**
 * Class Logger
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class Logger
{
    /**
     * Default logfile path (local to execution)
     * @var string
     */
    private static $_logfile = 'execute.log';

    /**
     * Build the Logger object
     *
     * @return void
     */
    public function __construct()
    {
        //nothing to see, move along
    }

    /**
     * Set a new log file path
     *
     * @param string $logPath Log file path
     *
     * @return void
     */
    public function setLogfile($logPath)
    {
        if (is_writeable($logPath)) {
            $this->_logfile = $logPath;
        }
    }

    /**
     * Write the line to the log file
     *
     * @param string $msg Line to write to file
     *
     * @return bool Write success/fail
     */
    public function write($msg)
    {
        // see if we have a custom log file
        $customLog = \Usher\Lib\Console::getOption('logFile');
        if ($customLog !== null) {
            self::$_logfile = $customLog;
        }

        // write to the file
        $ret = file_put_contents(self::$_logfile, $msg."\n", FILE_APPEND);
        return ($ret === false) ? false : true;
    }
}

?>