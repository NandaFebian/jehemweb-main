<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'ADMIN';
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case USER = 'USER';
}
