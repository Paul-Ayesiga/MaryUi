<?php
namespace App\Enums;

/**
 * PHP 8.1 compatible enum
 */
enum State: string
{
    case ALL = 'all';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function labels(): string
    {
        return match ($this) {
            self::ALL => 'All',
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            default => 'Other',
        };
    }

    // Returns labels for PowerGrid Select Filter
    public function labelPowergridFilter(): string
    {
        return $this->labels();
    }
}
