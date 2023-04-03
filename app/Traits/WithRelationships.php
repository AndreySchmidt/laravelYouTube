<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait WithRelationships
{
    // protected static $relationships = []; в пользователе будет конфликт, если оставить

    public function scopeWithRelationships($query, array|string $with)
    {
        // усли $with строка, преобразую в массив Arr::wrap($with)
        // return $query->with(array_intersect(Arr::wrap($with), static::$relationships));
        return $query->with(array_intersect(Arr::wrap($with), static::$relationships ?? []));
    }
}