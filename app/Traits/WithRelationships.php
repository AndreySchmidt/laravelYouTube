<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait WithRelationships
{
    // protected static $relationships = []; в пользователе будет конфликт, если оставить

    public function scopeWithRelationships($query, array|string $with)
    {
        // Он воспринимает вложенные отношения как строку, поэтому ее можно разбить через точку explode(string $separator, string $string): array
        // но я пойду другим путем или нет ща посмотрим
        // $relationships = Arr::wrap($with); строку в массив не надо болше ибо collect() преобразует ее в коллекцию (и массив строк туда же)
        $valid = collect($with)
        // ->dump()
        ->map(fn (string $with):array => explode('.', $with))
        // ->filter(fn (array $with): bool => in_array($with[0], static::$relationships))
        ->filter(function (array $with)
        {
            return collect($with)->reduce(function ($model, $withItem)
            {
                // dd(new static);
                if($model && method_exists($model, $withItem) && in_array($withItem, $model::$relationships))
                {
                    return $model->$withItem()->getRelated();
                }

                // new static (ссылка на текущий класс function (->>>>$model<<<-   ) вторым аргументом надо передать начальное значение,
                // его беру из объекта модели который в данный момент итерирую
            }, new static);
        })
        // ->dump()
        ->map(fn (array $with):string => implode('.', $with))
        // ->dump()
        ->all();

        // усли $with строка, преобразую в массив Arr::wrap($with)
        // return $query->with(array_intersect(Arr::wrap($with), static::$relationships ?? []));

        return $query->with($valid);
    }
}