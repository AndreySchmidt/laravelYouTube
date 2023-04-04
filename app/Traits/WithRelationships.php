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
        ->filter(function (array $with){
            // return static::hasRelationships($with);
            // более уместным будет вариант вызова через инстанс модели, на которой проверка,
            // потому что мы проверяет отношения на объекте определенной модели, перепишу через позднее статическое связывание так:
            return (new static)->hasRelationships($with);
        })
        // ->dump()
        ->map(fn (array $with):string => implode('.', $with))
        // ->dump()
        ->all();

        // усли $with строка, преобразую в массив Arr::wrap($with)
        // return $query->with(array_intersect(Arr::wrap($with), static::$relationships ?? []));

        return $query->with($valid);
    }

    // public static function hasRelationships(array $relationships)
    public function hasRelationships(array $relationships)
    {
        return collect($relationships)->reduce(function ($model, $relationshipsItem)
        {
            return optional($model)->hasRelationship($relationshipsItem);

            // new static (ссылка на текущий класс function (->>>>$model<<<-   ) вторым аргументом надо передать начальное значение,
            // его беру из объекта модели который в данный момент итерирую
        // }, new static);

        // мы находимся в контексте определенной модели (при вызове (new static)->hasRelationships($with); нет смысла опять это делать, берем её )
        }, $this);
    }

    public function hasRelationship(string $relationship)
    {
        // dd(new static);
        // if(method_exists($this, $relationship) && in_array($relationship, static::$relationships))
        if($this->isValidRelationship($relationship))
        {
            return $this->$relationship()->getRelated();
        }

        return null;
    }

    public function isValidRelationship($relationship)
    {
        return method_exists($this, $relationship) && in_array($relationship, static::$relationships);
    }
}