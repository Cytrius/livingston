<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account as AccountModel;
use App\User as UserModel;
use App\Settings as SettingsModel;

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

    public function getAccount($account_id) {

        $account = AccountModel::where('id', $account_id)->first();

        return response()->json($account);
    }

    public function deleteAccount(Request $request, $account_id) {

        $account = AccountModel::where('id', $account_id)->first();

        $account->delete();

        return response()->json([]);
    }

    public function saveAccount(Request $request, $account_id) {

        $account = AccountModel::where('id', $account_id)->first();

        if (!$account)
            return response('', 404);

        if (!$account->update($request->all()))
            return response('', 500);

        return response()->json($account);
    }

    public function newAccount(Request $request) {

        $account = AccountModel::create($request->all());

        return response()->json($account);

    }



    public function getSettings() {

        $settings = SettingsModel::all();

        $settingsArray = [];

        foreach($settings as $setting) {
            $settingsArray[$setting->setting] = $setting->value;
        }

        return response()->json($settingsArray);
    }

    public function saveSettings(Request $request) {
        $data = $request->all();

        foreach($data as $key => $val) {
            $setting = SettingsModel::where('setting', $key)->first();

            if (!$setting) {
                $setting = SettingsModel::create();
            }

            $setting->setting = $key;
            $setting->value = $val;

            $setting->save();
        }

        return response()->json([], 200);
    }



    public function getUser($user_id) {

        $user = UserModel::where('id', $user_id)->with('account')->first();

        return response()->json($user);
    }

    public function deleteUser(Request $request, $user_id) {

        $user = UserModel::where('id', $user_id)->first();

        $user->delete();

        return response()->json([]);
    }

    public function saveUser(Request $request, $user_id) {

        $user = UserModel::where('id', $user_id)->first();

        if (!$user)
            return response('', 404);

        $data = $request->all();

        if ($request->has('password'))
            $data['password'] = bcrypt($data['password']);

        if (!$user->update($data))
            return response('', 500);

        return response()->json($user);
    }

    public function newUser(Request $request, $account_id) {

        $user = UserModel::create([
            'name' => 'New User',
            'email' => time().'@email.com',
            'account_id' => $account_id
        ]);

        $user->account_id = $account_id;

        return response()->json($user);

    }

    
}
