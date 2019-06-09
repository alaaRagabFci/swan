<?php
namespace App\Constants;

/**
 * @package User
 * @author Alaa <alaaragab34@gmail.com>
 * UserRole
 */
class InvoiceStatus {
    /**
     * @const PAID
     */
    const PAID = 'Paid';

    /**
     * @const COMPANY
     */
    const UNPAID = 'Unpaid';

    /**
     * Get user role
     * @author Alaa <alaaragab34@gmail.com>
     *
     * @return array
     */
    public static function getInvoiceStatus() {
        return array(
            self::PAID => self::PAID,
            self::UNPAID => self::UNPAID
        );
    }
}