<?php

namespace App\Services\Quote;

/**
 * Contract interface for quote service drivers
 */
interface QuoteDriverContract
{
    /**
     * Fetch quotes
     * @param int $limit
     * @return array
     */
    public function fetch(int $limit = 5): array;
}
