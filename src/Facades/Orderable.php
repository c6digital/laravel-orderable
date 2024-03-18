<?php

namespace C6Digital\Orderable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \C6Digital\Orderable\Orderable
 */
class Orderable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \C6Digital\Orderable\Orderable::class;
    }
}
