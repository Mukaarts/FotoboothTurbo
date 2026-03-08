<?php

namespace App\Enum;

enum TarifTier: string
{
    case BASIC = 'basic';
    case STANDARD = 'standard';
    case PREMIUM = 'premium';

    public function label(): string
    {
        return match ($this) {
            self::BASIC => 'Basis',
            self::STANDARD => 'Standard',
            self::PREMIUM => 'Premium',
        };
    }
}
