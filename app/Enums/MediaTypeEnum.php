<?php

namespace App\Enums;

enum MediaTypeEnum
{
    const IMAGE = 'image';
    const FILE = 'file';

    public static function values(): array
    {
        return [
            self::IMAGE,
            self::FILE
        ];
    }
}
