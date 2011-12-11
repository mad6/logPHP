<?php

namespace codemonster\logphp;

/**
 * FileLogger writes log messages to a file.
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
class FileLogger extends Logger
{

    /**
     * Log file pointer.
     * @var resource 
     */
    private $fileptr = null;

    /**
     * @param type $filename Filename
     * @param type $level Log level [optional]
     */
    public function __construct(config\FileLoggerConfig $config)
    {
        $this->openFile($config->getFilename(), $config->getFileMode(),
                $config->getDirMode());
        parent::__construct($config);
    }

    /**
     * Adds a message to the log.
     * @param string $message Message
     * @param int $priority Message priority
     * @return bool 
     */
    protected function doLog($message, $priority)
    {
        $result = false;
        
        if (flock($this->fileptr, LOCK_EX))
        {
            $count = fwrite($this->fileptr,
                    sprintf("%s [%s]\t%s%s", $this->getTimeString(),
                            $this->getPriority($priority), $message, PHP_EOL));
            flock($this->fileptr, LOCK_UN);
            $result = ($count > 0 ? true : false);
        }

        return $result;
    }

    /**
     * Executes the shutdown procedure.
     */
    protected function shutdown()
    {
        parent::shutdown();
        $this->closeFile();
    }

    /**
     * Opens a log file for writing.
     * @param string $filename Filename
     * @param int $file_mode File mode
     * @param int $dir_mode Directory mode
     */
    private function openFile($filename, $file_mode, $dir_mode)
    {
        $dir = dirname($filename);

        if (!is_dir($dir))
        {
            \mkdir($dir, $dir_mode, true);
            \chmod($dir, $dir_mode);
        }

        if (!is_writable($dir))
        {
            throw new Exception(sprintf('Logger destination directory "%s" ' .
                            'is not writable.', $dir));
        }

        $file_exists = file_exists($filename);
        $this->fileptr = fopen($filename, 'a');

        if ($this->fileptr === false)
        {
            throw new Exception(sprintf('Unable to open the log file "%s" ' .
                            'for writing.', $filename));
        }

        if (!$file_exists)
        {
            \chmod($filename, $file_mode);
        }
    }

    /**
     * Closes the log file.
     */
    private function closeFile()
    {
        if (is_resource($this->fileptr))
        {
            fclose($this->fileptr);
        }
    }

}
