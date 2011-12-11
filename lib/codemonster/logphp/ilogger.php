<?php

namespace codemonster\logphp;

/**
 * Logger interface.
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
interface ILogger
{

    /**
     * Adds a message to the log.
     * @param string $message Message
     * @param int $priority Message priority
     */
    public function log($message, $priority);
}
