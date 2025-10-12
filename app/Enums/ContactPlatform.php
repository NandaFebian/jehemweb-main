<?php

namespace App\Enums;

enum ContactPlatform: string
{
    case INSTAGRAM = 'Instagram';
    case TIKTOK = 'Tiktok';
    case FACEBOOK = 'Facebook';
    case WA = 'WA';

    public static function option(): array
    {
        return [
            self::INSTAGRAM->value => 'Instagram',
            self::TIKTOK->value => 'Tiktok',
            self::FACEBOOK->value => 'Facebook',
            self::WA->value => 'WA',
        ];
    }
}
