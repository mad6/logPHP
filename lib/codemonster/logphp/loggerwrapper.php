<?php

namespace codemonster\logphp;

/**
 * LoggerWrapper wraps a class that implements ILogger interface into an object 
 * which extends Logger class.
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
class LoggerWrapper extends Logger
{

    /**
     * Logger object.
     * @var codemonster\logphp\ILogger 
     */
    private $logger;

    /**
     * @param codemonster\logphp\ILogger $logger Logger object
     */
    public function __construct(ILogger $logger, config\LoggerConfig $config)
    {
        $this->logger = $logger;
        parent::__construct($config);
    }

    /**
     * Adds a message to the log.
     * @param string $message Message
     * @param int $priority Message prority
     * @return bool 
     */
    protected function doLog($message, $priority)
    {
        return $this->logger->log($message, $priority);
    }

}
