<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account as AccountModel;
use App\Rates as RatesModel;

class RatesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getAllRates(Request $request) {

        $rates = RatesModel::select('*');

        $rates->limit(10);

        if ($request->has('page'))
            $rates->offset($request->get('page')*10);

        $rates = $rates->get();

        return response()->json($rates);
    }

    public function getRate(Request $request, $rate_id) {

        $rate = RatesModel::where('id', $rate_id)->first();

        return response()->json($rate);
    }

    public function deleteRate(Request $request, $rate_id) {

        $rate = RatesModel::where('id', $rate_id)->first();

        $rate->delete();

        return response()->json([]);
    }

    public function saveRate(Request $request, $rate_id) {

        $rate = RatesModel::where('id', $rate_id)->first();

        if (!$rate)
            return response('', 404);

        if (!$rate->update($request->all()))
            return response('', 500);

        return response()->json($rate);
    }

    public function newRate(Request $request) {

        $rate = RatesModel::create($request->all());

        return response()->json($rate);
    }

    public function getFilteredRates(Request $request) {

        $rates = RatesModel::select('*');

        if ($request->has('origin'))
            $rates->where('origin', $request->get('origin'));

        if ($request->has('destination'))
            $rates->where('destination', $request->get('destination'));

        if ($request->has('type'))
            $rates->where('type', $request->get('type'));

        if ($request->has('account'))
            $rates->where('account_type', $request->get('account'));

        $rates->limit(10);

        if ($request->has('page'))
            $rates->offset($request->get('page')*10);

        $rates = $rates->get();

        return response()->json($rates);
    }

    public function getAllRatesFilters() {

        $origins = RatesModel::select('origin')->groupBy('origin')->get();

        $destinations = RatesModel::select('destination')->groupBy('destination')->get();

        $types = RatesModel::select('type')->groupBy('type')->get();

        $accounts = RatesModel::select('account_type')->groupBy('account_type')->get();

        $results = [
            'origins' => $origins,
            'destinations' => $destinations,
            'types' => $types,
            'accounts' => $accounts
        ];

        return response()->json($results);
    }

    
}
