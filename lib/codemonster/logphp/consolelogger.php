<?php

namespace codemonster\logphp;

/**
 * ConsoleLogger writes a log messages to the console. 
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
class ConsoleLogger extends Logger
{

    /**
     * Add a message to the log.
     * @param string $message Message
     * @param int $priority Message priority
     * @return bool 
     */
    protected function doLog($message, $priority)
    {
        printf("%s [%s]\t%s%s", $this->getTimeString(),
                $this->getPriority($priority), $message, PHP_EOL);
        return true;
    }

}
