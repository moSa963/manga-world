<?php

namespace App\Enums;

enum SeriesStatus: string
{
    case ONGOING = "ongoing";
    case STOPPED = "stopped";
    case FINISHED = "finished";

    public static function values(): array
    {
        return array_column(self::cases(), "value");
    }
}
