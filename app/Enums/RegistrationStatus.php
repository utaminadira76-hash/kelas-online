<?php

namespace App\Enums;

enum RegistrationStatus: string
{
    case PENDING = 'pending';
    case DITERIMA = 'diterima';
    case DITOLAK = 'ditolak';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::DITERIMA => 'Diterima',
            self::DITOLAK => 'Ditolak',
        };
    }
}