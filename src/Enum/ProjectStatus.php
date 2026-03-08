<?php

namespace App\Enum;

enum ProjectStatus: string
{
    case DRAFT = 'draft';
    case AWAITING_CUSTOMER = 'awaiting_customer';
    case AWAITING_APPROVAL = 'awaiting_approval';
    case APPROVED = 'approved';
    case EXPORTED = 'exported';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Entwurf',
            self::AWAITING_CUSTOMER => 'Warten auf Kunde',
            self::AWAITING_APPROVAL => 'Warten auf Freigabe',
            self::APPROVED => 'Freigegeben',
            self::EXPORTED => 'Exportiert',
            self::ARCHIVED => 'Archiviert',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::AWAITING_CUSTOMER => 'yellow',
            self::AWAITING_APPROVAL => 'orange',
            self::APPROVED => 'green',
            self::EXPORTED => 'blue',
            self::ARCHIVED => 'slate',
        };
    }
}
