<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

/**
 *
 */
class QuoteTest extends TestCase
{

    /**
     * Test quote listing page response status code and inertia component with props 'quotes'
     * @return void
     */
    public function test_quote_listing_page_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Quotes')
            ->has('quotes')
        );
    }

    /**
     * Test quote refresh api response status code, test response has valid json, check json is an array
     * and it has 5 items.
     * @return void
     * @throws \Throwable
     */
    public function test_quote_refresh_api_successful_response(): void
    {
        $response = $this->get('/api/quotes');

        $response->assertStatus(200);

        $response->assertJsonIsArray();

        $json = $response->decodeResponseJson();

        $this->assertCount(5, $json);
    }

    /**
     * Test quote refresh api limit response status code, test response has valid json, check json is an array
     * and it has 5 items.
     * @return void
     * @throws \Throwable
     */
    public function test_quote_refresh_api_limit_successful_response(): void
    {
        $limit = 10;

        $response = $this->get('/api/quotes?limit=' . $limit);

        $response->assertStatus(200);

        $response->assertJsonIsArray();

        $json = $response->decodeResponseJson();

        $this->assertCount($limit, $json);
    }
}
