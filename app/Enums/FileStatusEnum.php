<?php

namespace App\Enums;

enum FileStatusEnum:string
{
    case PENDING = 'PENDING';
    case PROCESSING = 'PROCESSING';
    case FAILED = 'FAILED';
    case COMPLETED = 'COMPLETED';
}
