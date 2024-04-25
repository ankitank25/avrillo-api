<?php

namespace App\Services\Quote\Drivers;

use App\Services\Quote\QuoteDriverContract;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Kanye quote driver class
 */
class KanyeDriver implements QuoteDriverContract
{
    /**
     * Kanye API URL
     */
    const API_URL = 'https://api.kanye.rest/';

    /**
     * Fetch quotes using Kanye APIs
     * @param int $limit
     * @return array
     */
    public function fetch(int $limit = 5): array
    {
        try {
            $quotes = [];
            do {
                $response = $this->makeApiCall();
                if (isset($response['quote']) && $quote = $response['quote']) {
                    if (!in_array($quote, $quotes)) {
                        $quotes[] = $quote;
                    }
                }
            } while (count($quotes) < $limit);

            return $quotes;
        } catch (Throwable $throwable) {
            Log::error($throwable);
        }

        return [];
    }

    /**
     * Make Kanye API request.
     * @return array
     * @throws Exception
     * @throws Exception
     */
    private function makeApiCall(): array
    {
        $apiToken = config('quote.kanye_api_token');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::API_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $apiToken,
                'Accept: application/json',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) throw new Exception(curl_error($curl));

        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
            $response = json_decode($response, true);

            curl_close($curl);

            return $response;
        }

        return [];
    }
}
