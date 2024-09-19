<?php

namespace App\Enums;

/**
 * only php8.1
 */
enum Status: string
{
    case ALL    = 'all';
    case PENDING  = 'pending';
    case APPROVED = 'approved';
    case DISBURSED = 'disbursed';
    case REJECTED = 'rejected';

    public function labels(): string
    {
        return match ($this) {
            // self::ALL => 'All',
            self::PENDING  => 'pending',
            self::APPROVED => 'approved',
            self::DISBURSED => 'disbursed',
            self::REJECTED => 'rejected',
            default => 'other',
        };
    }

    // Returns labels for PowerGrid Select Filter
    public function labelPowergridFilter(): string
    {
        return $this->labels();
    }
}
