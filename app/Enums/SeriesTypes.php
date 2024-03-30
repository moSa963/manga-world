<?php

namespace App\Enums;

enum SeriesTypes: string
{
    case MANGA = "manga";
    case MANHWA = "manhwa";

    public static function values(): array
    {
        return array_column(self::cases(), "value");
    }
}
