<?php

namespace App\Traits;

trait WithRelationships
{
    public function scopeWithRelationships($query, $with)
    {
        // $valid = collect($with)
        // ->map(fn (string $with):array => explode('.', $with))
        // ->filter(fn (array $with):bool => (new static)->hasRelationships($with))
        // ->map(fn (array $with):string => implode('.', $with))
        // ->all();

        return $query->with($this->validRelationships($with));
    }
    public function loadRelationships($relationships)
    {
        return $this->load($this->validRelationships($relationships));
    }

    public function hasRelationships(array $relationships)
    {
        return (bool) collect($relationships)
            ->reduce(fn ($model, $relationshipsItem) => optional($model)->hasRelationship($relationshipsItem), $this);
    }

    public function hasRelationship(string $relationship)
    {
        return ($this->isValidRelationship($relationship))? $this->$relationship()->getRelated() : null;
    }

    public function isValidRelationship($relationship)
    {
        return method_exists($this, $relationship) && in_array($relationship, static::$relationships);
    }

    public function validRelationships($relationships)
    {
        return collect($relationships)
            ->map(fn (string $relationships):array => explode('.', $relationships))
            ->filter(fn (array $relationships):bool => (new static)->hasRelationships($relationships))
            ->map(fn (array $relationships):string => implode('.', $relationships))
            ->all();
    }
}