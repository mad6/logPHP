<?php

namespace codemonster\logphp;

/**
 * Priority groups the constans used as a logging levels and priorities of the 
 * messages.
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
abstract class Priority
{
    /** System is unusable */
    const EMERG = 0;

    /** Immediate action required */
    const ALERT = 1;

    /** Critical conditions */
    const CRIT = 2;

    /** Error conditions */
    const ERR = 3;

    /** Warning conditions */
    const WARNING = 4;

    /** Normal but significant */
    const NOTICE = 5;

    /** Informational */
    const INFO = 6;

    /** Debug-level messages */
    const DEBUG = 7;

    /**
     * Array of priority names.
     * @var array 
     */
    private static $priority_names = array(
        self::EMERG => 'emerg',
        self::ALERT => 'alert',
        self::CRIT => 'crit',
        self::ERR => 'err',
        self::WARNING => 'warning',
        self::NOTICE => 'notice',
        self::INFO => 'info',
        self::DEBUG => 'debug'
    );

    /**
     * Returns true if log priority is valid.
     * @param int $priority Priority
     * @return bool 
     */
    public static function isValidPriority($priority)
    {
        return isset(self::$priority_names[$priority]);
    }

    /**
     * Returns the priority name or false when the value is invalid.
     * @param int $priority Priority
     * @return string|false 
     */
    public static function getPriorityName($priority)
    {
        if (!isset(self::$priority_names[$priority]))
        {
            return false;
        }

        return self::$priority_names[$priority];
    }

}
