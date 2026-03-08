<?php

namespace App\Enum;

enum ApprovalStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REVISION_REQUESTED = 'revision_requested';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Ausstehend',
            self::APPROVED => 'Freigegeben',
            self::REVISION_REQUESTED => 'Überarbeitung angefragt',
        };
    }
}
