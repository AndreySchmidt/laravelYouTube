<?php

namespace App\Enums;

use Illuminate\Support\Carbon;

// тип данных на входе перечисления string
enum Period: string
{
    case Year = 'year';
    case Month = 'month';
    case Week = 'week';
    case Day = 'day';
    case Hour = 'hour';

    public function date(): Carbon
    {
        // $this указывает на объект текущего перечисления для того, чтобы матч имел доступ к свойствам
        return match($this)
        {
            static::Year => now()->startOfYear(),
            static::Month => now()->startOfMonth(),
            static::Week => now()->startOfWeek(),
            static::Day => now()->startOfDay(),
            static::Hour => now()->startOfHour(),
            // default => null, // по дефолту другие данные идут, тут только с указаным периодом в гет
        };
    }
}
