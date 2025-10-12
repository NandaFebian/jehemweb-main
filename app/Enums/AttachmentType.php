<?php

namespace App\Enums;

enum AttachmentType: string
{
    case VIDEO = 'VIDEO';
    case IMAGE = 'IMAGE';

    public static function option(): array
    {
        return [
            self::VIDEO->value => 'Video',
            self::IMAGE->value => 'Image',
        ];
    }
}
