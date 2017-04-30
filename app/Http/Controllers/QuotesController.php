<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account as AccountModel;
use App\Quotes as QuotesModel;

use Carbon\Carbon;

class QuotesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getAllQuotes() {

        $quotes = QuotesModel::with('account')->with('user')->get();

        return response()->json($quotes);
    }

    public function getFilteredQuotes(Request $request) {

        $quotes = QuotesModel::select('*');

        if ($request->has('origin'))
            $quotes->where('origin', $request->get('origin'));

        if ($request->has('destination'))
            $quotes->where('destination', $request->get('destination'));

        if ($request->has('account'))
            $quotes->where('account_id', $request->get('account'));

        if ($request->has('created_at')) {
            $date = new Carbon($request->get('created_at'));
            $day_start = $date->copy()->startOfDay();
            $day_end = $date->copy()->endOfDay();
            $quotes->where('created_at', '>=', $day_start)->where('created_at', '<=', $day_end);
        }

        $quotes = $quotes->with('account')->with('user')->get();

        return response()->json($quotes);
    }

    public function getAllQuotesFilters() {

        $accounts = QuotesModel::select('account_id')->groupBy('account_id')->with('account')->get();

        $origins = QuotesModel::select('origin')->groupBy('origin')->get();

        $destinations = QuotesModel::select('destination')->groupBy('destination')->get();

        $results = [
            'origins' => $origins,
            'destinations' => $destinations,
            'accounts' => $accounts
        ];

        return response()->json($results);
        
    }

    
}
