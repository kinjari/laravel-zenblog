<?php

namespace Kinjari\LaravelZenblog\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kinjari\LaravelZenblog\LaravelZenblog
 */
class LaravelZenblog extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Kinjari\LaravelZenblog\LaravelZenblog::class;
    }
}
