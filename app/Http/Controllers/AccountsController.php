<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account as AccountModel;
use App\User as UserModel;

class AccountsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getAllAccounts() {

        $rates = AccountModel::get();

        return response()->json($rates);
    }

    public function getFilteredAccounts(Request $request) {

        $rates = AccountModel::select('*');

        if ($request->has('origin'))
            $rates->where('origin', $request->get('origin'));

        if ($request->has('destination'))
            $rates->where('destination', $request->get('destination'));

        if ($request->has('type'))
            $rates->where('type', $request->get('type'));

        if ($request->has('account'))
            $rates->where('account_type', $request->get('account'));

        $rates = $rates->get();

        return response()->json($rates);
    }

    public function getAllAccountsFilters() {

        /*
        $origins = AccountModel::select('origin')->groupBy('origin')->get();

        $destinations = AccountModel::select('destination')->groupBy('destination')->get();

        $types = AccountModel::select('type')->groupBy('type')->get();

        $accounts = AccountModel::select('account_type')->groupBy('account_type')->get();
    */
        
        $results = [
        /*
            'origins' => $origins,
            'destinations' => $destinations,
            'types' => $types,
            'accounts' => $accounts
            */
        ];

        return response()->json($results);
    }

    public function getUsersByAccountId($account_id) {

        $users = UserModel::where('account_id', $account_id)->with('account')->get();

        return response()->json($users);
    }

    
}
