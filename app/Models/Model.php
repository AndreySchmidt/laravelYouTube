<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected static $relationships = [];

    public function scopeWithRelationships($query, array|string $with)
    {
        // усли $with строка, преобразую в массив Arr::wrap($with)
        return $query->with(array_intersect(Arr::wrap($with), static::$relationships));
    }
}
