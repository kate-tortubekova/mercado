<?php

namespace App\Enum;

enum CascadeEnum: string
{
    case PERSIST = 'persist';
    case REMOVE = 'remove';
    case REFRESH = 'refresh';
    case DETACH = 'detach';
    case ALL = 'all';
}