<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * Quote listing page testing
 */
class QuoteListingPageTest extends DuskTestCase
{
    /**
     * Test quote listing page render and screenshot.
     * @return void
     * @throws \Throwable
     */
    public function testQuoteListingPage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Kanye West\'s Quotes');

            $browser->screenshot('quote-listing-page');
        });
    }

    /**
     * Test quote listing refresh button render and screenshot.
     * @return void
     * @throws \Throwable
     */
    public function testQuoteListingRefreshButton(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertPresent('#refresh-button');

            $browser->scrollIntoView('#refresh-button');
            $browser->screenshotElement('#refresh-button', 'quote-listing-refresh-button');
        });
    }

    /**
     * Test quote listing refresh event and screenshot before and after.
     * @return void
     * @throws \Throwable
     */
    public function testQuoteListingRefresh(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->scrollIntoView('#quote-list');
            $browser->screenshotElement('#quote-list', 'quote-listing-refresh-before');
            $browser->click('#refresh-button');
            $browser->pause(3000);
            $browser->screenshotElement('#quote-list', 'quote-listing-refresh-after');
        });
    }
}
