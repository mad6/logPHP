<?php

namespace codemonster\logphp\config;

use codemonster\logphp\Priority;

/**
 * LoggerConfig is a base configuration for Logger.
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
class LoggerConfig
{

    /**
     * Logging level.
     * @param int
     */
    private $level;

    /**
     * Time format.
     * @var string 
     */
    private $time_format;

    /**
     * @param int $level Logging level ie. value from logphp\Priority class
     */
    public function __construct($level = Priority::INFO)
    {
        $this->setLogLevel($level);
        $this->setTimeFormat('%b %d %H:%M:%S');
    }

    /**
     * Sets the logging level.
     * @param int $priority Priority 
     */
    public function setLogLevel($priority)
    {
        if (!Priority::isValidPriority($priority))
        {
            throw new LoggerConfigException(
                    sprintf('Invalid log level value "%s".', $priority));
        }

        $this->level = (int) $priority;
    }

    /**
     * Gets the logging level.
     * @return int 
     */
    public function getLogLevel()
    {
        return $this->level;
    }

    /**
     * Sets the time format.
     * @param string $format Time format ex. '%b %d %H:%M:%S'
     */
    public function setTimeFormat($format)
    {
        if (!is_string($format) || empty($format))
        {
            throw new LoggerConfigException('Time format is empty.');
        }

        $this->time_format = (string) $format;
    }

    /**
     * Gets the time format.
     * @return string 
     */
    public function getTimeFormat()
    {
        return $this->time_format;
    }

}
