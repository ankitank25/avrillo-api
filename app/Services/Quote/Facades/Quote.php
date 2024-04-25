<?php

namespace App\Services\Quote\Facades;

use App\Services\Quote\QuoteDriverContract;
use App\Services\Quote\QuoteServiceManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static QuoteDriverContract driver(string $key)
 *
 * @see QuoteServiceManager
 */
class Quote extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return QuoteServiceManager::class;
    }
}
