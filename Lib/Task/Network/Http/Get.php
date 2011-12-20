<?php
/**
 * Make a GET request to a remote URL
 *
 * PHP Version 5
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Task\Network\Http;

/**
 * Class GetTask
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class GetTask extends \Usher\Lib\Task
{
    /**
     * HTTP socket
     * @var resource
     */
    private $_socket = null;

    /**
     * Hostname for the connection
     * @var string
     */
    private $_host = null;

    /**
     * Default port for the connection
     * @var int
     */
    private $_port = 80;

    /**
     * Execute the task
     *
     * @return void
     */
    public function execute()
    {
        $url        = $this->getOption('url');
        $outputFile = $this->getOption('outputFile');
        $parsedUrl  = parse_url($url);
        $output     = '';
        $path       = (isset($parsedUrl['path'])) ? $parsedUrl['path'] : '/';

        if (isset($parsedUrl['host'])) {

            $this->_host    = $parsedUrl['host'];
            $this->_socket  = fsockopen($this->_host, $this->_port, $errno, $errstr);

            if (!$this->_socket) {
                throw new \Exception(
                    'Could not open socket for GET request to '.
                    $host.' ('.$erno.':'.$errstr.')'
                );
            } else {
                $request = $this->_buildRequest($path);
                fwrite($this->_socket, $request);
                while (!feof($this->_socket)) {
                    $output .= fread($this->_socket, 1024);
                }
                if ($outputFile != null) {
                    file_put_contents($outputFile, $output);
                }
            }
        } else {
            throw new \Exception('Could not determine hostname for URL: '.$url);
        }
    }

    /**
     * Build the GET request
     *
     * @param string $path Path to request (defaults to "/")
     * 
     * @return string $request Formatted GET request
     */
    private function _buildRequest($path='/')
    {
        $request  = '';
        $request .= 'GET '.$path.' HTTP/1.0'."\r\n";
        $request .= "\r\n\r\n";

        return $request;
    }
}

?>