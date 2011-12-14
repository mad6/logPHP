<?php

namespace codemonster\logphp;

/**
 * Logger is a base class for all type of loggers. 
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
abstract class Logger
{

    /**
     * Logger log level.
     * @var int 
     */
    private $level;

    /**
     * Time format string.
     * @var string 
     */
    private $time_format;

    /**
     * @param codemonster\logphp\config\LoggerConfig $config Logger config
     */
    public function __construct(config\LoggerConfig $config)
    {
        $this->setLogLevel($config->getLogLevel());
        $this->time_format = $config->getTimeFormat();
        $this->initialize();
    }

    /**
     * Sets the log level.
     * @param int $level Priority
     */
    public function setLogLevel($level)
    {
        if (!Priority::isValidPriority($level))
        {
            throw new LoggerException(sprintf('Invalid log level value "%s".', $level));
        }

        $this->level = $level;
    }

    /**
     * Gets the log level.
     * @return bool 
     */
    public function getLogLevel()
    {
        return $this->level;
    }

    /**
     * Logs a emergency message. 
     * @param string $message Message
     * @return bool
     */
    public function emerg($message)
    {
        return $this->log($message, Priority::EMERG);
    }

    /**
     * Logs a alert message.
     * @param string $message Message
     * @return bool
     */
    public function alert($message)
    {
        return $this->log($message, Priority::ALERT);
    }

    /**
     * Logs a critical message.
     * @param string $message Message
     * @return bool
     */
    public function crit($message)
    {
        return $this->log($message, Priority::CRIT);
    }

    /**
     * Logs a error message.
     * @param string $message Message
     * @return bool
     */
    public function err($message)
    {
        return $this->log($message, Priority::ERR);
    }

    /**
     * Logs a warning message.
     * @param string $message Message
     * @return bool
     */
    public function warning($message)
    {
        return $this->log($message, Priority::WARNING);
    }

    /**
     * Logs a notice message.
     * @param string $message Message
     * @return bool
     */
    public function notice($message)
    {
        return $this->log($message, Priority::NOTICE);
    }

    /**
     * Logs a info message.
     * @param string $message Message
     * @return bool
     */
    public function info($message)
    {
        return $this->log($message, Priority::INFO);
    }

    /**
     * Logs a debug message.
     * @param string $message Message
     * @return bool
     */
    public function debug($message)
    {
        return $this->log($message, Priority::DEBUG);
    }

    /**
     * Logs a message.
     * @param string $message Message
     * @param int $priority Message priority
     * @return bool
     */
    public function log($message, $priority = Priority::INFO)
    {
        if ($this->getLogLevel() < $priority)
        {
            return false;
        }

        return $this->doLog($message, $priority);
    }

    /**
     * Initializes the logger.
     */
    protected function initialize()
    {
        
    }

    /**
     * Execute the shutdown procedure.
     */
    protected function shutdown()
    {
        
    }

    /**
     * Returns current time as a formated string.
     * @return string
     */
    protected function getTimeString()
    {
        return strftime($this->time_format);
    }

    /**
     * Gets priority name.
     * @param int $priority Priority
     * @return string 
     */
    protected function getPriority($priority)
    {
        return Priority::getPriorityName($priority);
    }

    /**
     * Adds a message to the log.
     * @param string $message Message
     * @param int $priority Message priority
     * @return bool
     */
    protected abstract function doLog($message, $priority);

    public function __destruct()
    {
        $this->shutdown();
    }

}
