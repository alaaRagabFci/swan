<?php
namespace App\Constants;

/**
 * @package User
 * @author Alaa <alaaragab34@gmail.com>
 * UserRole
 */
class OrderStatus {
    /**
     * @const PENDING
     */
    const PENDING = 'Pending';

    /**
     * @const ACCEPTED
     */
    const ACCEPTED = 'Accepted';

    /**
     * @const COMPLETED
     */
    const COMPLETED = 'Completed';

    /**
     * @const CANCELLED
     */
    const CANCELLED = 'Cancelled';

    /**
     * @const UNDER_APPRAISAL
     */
    const UNDER_APPRAISAL = 'Under_Appraisal';

    /**
     * @const HANGING
     */
    const HANGING = 'Hanging';

    /**
     * @const NOT_ASSIGN
     */
    const NOT_ASSIGN = 'Not_Assign';

    /**
     * @const HANGING
     */
    const SMS_NOT_CONFIRMED = 'Sms_Not_Confirmed';

    /**
     * Get user role
     * @author Alaa <alaaragab34@gmail.com>
     *
     * @return array
     */
    public static function getOrderStatus() {
        return array(
            self::PENDING => self::PENDING,
            self::ACCEPTED => self::ACCEPTED,
            self::COMPLETED => self::COMPLETED,
            self::CANCELLED => self::CANCELLED,
            self::UNDER_APPRAISAL => self::UNDER_APPRAISAL,
            self::HANGING => self::HANGING,
            self::NOT_ASSIGN => self::NOT_ASSIGN,
            self::SMS_NOT_CONFIRMED => self::SMS_NOT_CONFIRMED
        );
    }
}