<?php
 /**
 * Send an email to the given addresses
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Lib\Task\Contact;

/**
 * Class DocbloxTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class EmailTask extends \Usher\Lib\Task
{
    /**
     * Execute the task
     *
     * @return void
     */
    public function execute()
    {
        $to = $this->getOption('addresses');

        $headers  = "From: usher-output@test.com\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        if ($to == null) {
            throw new \Exception('"To" address(es) must be specified');
        }

        $subject = ($this->getOption('subject') !== null) 
            ? $this->getOption('subject') : 'Output from build @ '.date('m.d.Y H:i:s');

        $content = nl2br(ob_get_contents());

        try {
            foreach (explode(',',$to) as $emailAddress) {
                mail($emailAddress,$subject,$content,$headers);
            }
        }catch(\Exception $e){
            throw new \Exception('Error on command: '.$e->getMessage());
        }
    }
}

