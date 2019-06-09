<?php
namespace App\Constants;

/**
 * @package Notification
 * @author Alaa <alaaragab34@gmail.com>
 * NotificationType
 */
class NotificationType {
    /**
     * @const APPLICATION
     */
    const APPLICATION = 'Application';

    /**
     * @const CONTACTUS
     */
    const CONTACTUS = 'ContactUs';

    /**
     * Get notification type
     * @author Alaa <alaaragab34@gmail.com>
     *
     * @return array
     */
    public static function getNotificationType() {
        return array(
            self::APPLICATION => self::APPLICATION,
            self::CONTACTUS => self::CONTACTUS
        );
    }
}