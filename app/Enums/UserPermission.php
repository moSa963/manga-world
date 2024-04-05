<?php

namespace App\Enums;

enum UserPermission: string
{
    case CREATE = "create";
    case APPROVE = "approve";

    public static function values(): array
    {
        return array_column(self::cases(), "value");
    }
}
