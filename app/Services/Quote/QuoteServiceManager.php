<?php

namespace App\Services\Quote;

use App\Services\Quote\Drivers\KanyeDriver;
use Illuminate\Support\Manager;

/**
 * Quote service manager class
 */
class QuoteServiceManager extends Manager
{
    /**
     * Default quote driver
     */
    const DEFAULT_DRIVER = 'kanye';

    /**
     * Get default quote service driver
     */
    public function getDefaultDriver(): string
    {
        return self::DEFAULT_DRIVER;
    }

    /**
     * Create Kanye Quote Driver
     *
     * @return KanyeDriver
     */
    public function createKanyeDriver(): QuoteDriverContract
    {
        return new KanyeDriver();
    }
}
