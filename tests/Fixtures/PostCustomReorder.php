<?php

namespace C6Digital\Orderable\Tests\Fixtures;

use C6Digital\Orderable\Orderable;
use C6Digital\Orderable\OrderableOptions;
use Illuminate\Database\Eloquent\Model;

class PostCustomReorder extends Model
{
    use Orderable;

    protected $guarded = [];

    public static function getOrderableOptions(): OrderableOptions
    {
        return OrderableOptions::default()
            ->setOrderUsing(function (Model $model) {
                $model->order = 5000;
            });
    }
}
