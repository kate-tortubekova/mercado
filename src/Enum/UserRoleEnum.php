<?php

namespace App\Enum;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case MANAGER = 'manager';
}