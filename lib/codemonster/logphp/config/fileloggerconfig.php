<?php

namespace codemonster\logphp\config;

use codemonster\logphp\Priority;

/**
 * FileLoggerConfig is a configuration for FileLogger.
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
class FileLoggerConfig extends LoggerConfig
{

    /**
     * Log filename.
     * @var string 
     */
    private $filename;

    /**
     * File mode.
     * @param int
     */
    private $file_mode;

    /**
     * Directory mode.
     * @var int 
     */
    private $dir_mode;

    /**
     * @param string $filename Filename with path
     * @param int $level Logging level ie. value from logphp\Priority class
     */
    public function __construct($filename, $level = Priority::INFO)
    {
        parent::__construct($level);
        $this->setFilename($filename);
        $this->setFileMode(0666);
        $this->setDirMode(0777);
    }

    /**
     * Sets the log path and filename.
     * @param string $filename Filename with path
     */
    public function setFilename($filename)
    {
        if (empty($filename))
        {
            throw new LoggerConfigException('Log filename is empty');
        }

        $this->filename = (string) $filename;
    }

    /**
     * Gets the log path and filename.
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Sets the log creation file mode.
     * @param int $mode File mode ex. 0666 (octal value)
     */
    public function setFileMode($mode)
    {
        $this->file_mode = (int) $mode;
    }

    /**
     * Gets the log creation file mode.
     * @return int 
     */
    public function getFileMode()
    {
        return $this->file_mode;
    }

    /**
     * Sets the directory creation mode.
     * @param int $mode Directory mode ex. 0777 (octal value)
     */
    public function setDirMode($mode)
    {
        $this->dir_mode = (int) $mode;
    }

    /**
     * Gets the directory creation mode.
     * @return int 
     */
    public function getDirMode()
    {
        return $this->dir_mode;
    }

}
