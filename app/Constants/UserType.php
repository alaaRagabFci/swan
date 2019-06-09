<?php
namespace App\Constants;

/**
 * @package User
 * @author Alaa <alaaragab34@gmail.com>
 * UserRole
 */
class UserType {
    /**
     * @const ADMIN
     */
    const ADMIN = 'Admin';

    /**
     * @const COMPANY
     */
    const COMPANY = 'Company';

    /**
     * @const TEAM_WORK
     */
    const TEAM_WORK = 'Team_Work';

    /**
     * Get user role
     * @author Alaa <alaaragab34@gmail.com>
     *
     * @return array
     */
    public static function getUserType() {
        return array(
            self::ADMIN => self::ADMIN,
            self::COMPANY => self::COMPANY,
            self::TEAM_WORK => self::TEAM_WORK
        );
    }
}