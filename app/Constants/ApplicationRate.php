<?php
namespace App\Constants;

/**
 * @package User
 * @author Alaa <alaaragab34@gmail.com>
 * UserRole
 */
class ApplicationRate {
    /**
     * @const RATED
     */
    const RATED = 'Rated';

    /**
     * @const OPENED_NOT_RATED
     */
    const OPENED_NOT_RATED = 'Opend_Not_Rated';

    /**
     * @const NOT_OPENED
     */
    const NOT_OPENED = 'Not_Opened';

    /**
     * Get user role
     * @author Alaa <alaaragab34@gmail.com>
     *
     * @return array
     */
    public static function getApplicationRate() {
        return array(
            self::RATED => self::RATED,
            self::OPENED_NOT_RATED => self::OPENED_NOT_RATED,
            self::NOT_OPENED => self::NOT_OPENED
        );
    }
}