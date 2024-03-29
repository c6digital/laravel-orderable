<?php

namespace C6Digital\Orderable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait Orderable
{
    public static function bootOrderable(): void
    {
        static::creating(function (Model $model) {
            $options = static::getOrderableOptions();

            if ($callback = $options->getSetOrderUsing()) {
                $callback($model);

                return;
            }

            if (! $options->shouldReorderOnCreate()) {
                return;
            }

            $column = $options->getColumn();

            if ($options->shouldMoveToEndOnCreate()) {
                $model->{$column} = static::max($column) + 1;
            } elseif ($options->shouldMoveToStartOnCreate()) {
                $model->{$column} = 1;
            }
        });

        static::created(function (Model $model) {
            $options = static::getOrderableOptions();

            if ($options->shouldReorderOnCreate() && $options->shouldMoveToStartOnCreate()) {
                $model->reorder(exclude: $model->getKey());
            }
        });
    }

    public function scopeOrdered(Builder $query, string $direction = 'asc'): void
    {
        $options = static::getOrderableOptions();

        $query->orderBy($options->getColumn(), $direction);
    }

    public function scopeOrderedAsc(Builder $query): void
    {
        $this->scopeOrdered($query, 'asc');
    }

    public function scopeOrderedDesc(Builder $query): void
    {
        $this->scopeOrdered($query, 'desc');
    }

    public function reorder(?int $exclude = null): void
    {
        $options = static::getOrderableOptions();
        $column = $options->getColumn();

        static::query()
            ->when($exclude, fn ($query) => $query->whereKeyNot($exclude))
            ->increment($column);
    }

    public static function getOrderableOptions(): OrderableOptions
    {
        return OrderableOptions::default();
    }
}
