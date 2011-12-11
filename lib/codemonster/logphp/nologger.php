<?php

namespace codemonster\logphp;

/**
 * NoLogger is a dummy logger. 
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
final class NoLogger extends Logger
{

    /**
     * Adds a message to the log.
     * @param string $message Message
     * @param int $priority Message prority
     * @return bool 
     */
    protected function doLog($message, $priority)
    {
        return true;
    }

}
