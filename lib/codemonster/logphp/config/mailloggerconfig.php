<?php

namespace codemonster\logphp\config;

use codemonster\logphp\Priority;

/**
 * MailLoggerConfig is a configuration for MailLogger.
 * @author codemonster <codemonster@codemonster.pl>
 * @copyright 2011 CodeMonster.pl
 * @license http://www.gnu.org/licenses/lgpl.html
 * 
 * @package logPHP
 */
class MailLoggerConfig extends LoggerConfig
{

    /**
     * Destination emails.
     * @var string 
     */
    private $emails;

    /**
     * Level for email notification.
     * @var string 
     */
    private $notification_level;

    /**
     * Title for the email notification.
     * @var string 
     */
    private $title;

    /**
     * @param string $email Email address
     * @param string $name Email owner name
     * @param string $title Email notification title
     * @param int $level Logging level ie. value from logphp\Priority class 
     *      [optional]
     * @param int $notify_level Level for email notification 
     *      ie. value from logphp\Priority class
     * 
     * @throws codemonster\logphp\config\LoggerConfigException
     */
    public function __construct($email, $name, $title, $level = Priority::INFO,
            $notify_level = Priority::ERR)
    {
        parent::__construct($level);
        $this->emails = array();
        $this->addEmail($email);
        $this->setTitle($title);
        $this->setNotificationLevel($notify_level);
    }

    /**
     * Adds email.
     * @param string $email Email address
     * @param string $name Email owner name [optional]
     * 
     * @throws codemonster\logphp\config\LoggerConfigException
     */
    public function addEmail($email, $name = NULL)
    {
        if ($this->isValidEmail($email))
        {
            $this->emails[$email] = $name;
        }
        else
        {
            throw new LoggerConfigException(sprintf(
                            '"%s" is not a valid email address.', $email));
        }
    }

    /**
     * Gets email addresses.
     * @return array 
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Sets level for the email notification.
     * @param int $level Level ie. value from logphp\Priority class
     */
    public function setNotificationLevel($level)
    {
        if (!Priority::isValidPriority($level))
        {
            throw new LoggerConfigException(
                    sprintf('Invalid notification level value "%s".', $level));
        }

        $this->notification_level = (int) $level;
    }

    /**
     * Gets level for the email notification.
     * @return int 
     */
    public function getNotificationLevel()
    {
        return $this->notification_level;
    }

    /**
     * Sets title for the notification email.
     * @param string $title Title
     */
    public function setTitle($title)
    {
        if (!is_string($title) || empty($title))
        {
            throw new LoggerConfigException(
                    'Notification email title is empty.');
        }
        
        $this->title = (string) $title;
    }
    
    /**
     * Gets title for the notification email.
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns true if value is valid email address.
     * @param string $email Value to check
     * @return boolean 
     */
    private function isValidEmail($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL) !== false);
    }

}
