<?php

namespace App\Http\Controllers;

use App\Services\Quote\Facades\Quote;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * Quote Controller
 */
class QuoteController extends Controller
{
    /**
     * Quote list action method
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request) {
        $quotes = Quote::driver('kanye')->fetch($request->limit? :5);
        return Inertia::render('Quotes', [
            'quotes' => $quotes
        ]);
    }
}
