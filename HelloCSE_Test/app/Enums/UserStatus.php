<?php

namespace App\Enums;
enum UserStatus: string {
    case INACTIF = 'inactif';
    case EN_ATTENTE = 'en attente';
    case ACTIF = 'actif';

    /**
     * Summary of values
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}