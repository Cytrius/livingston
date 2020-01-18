<?php

namespace App\Http\Controllers;

use App\Account as AccountModel;
use App\Http\Controllers\QuotesController;
use App\Quotes as QuotesModel;
use App\Rates as RatesModel;
use App\Settings as SettingsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImportController extends Controller
{

    /**
     * @var string
     */
    private $parent_site = 'https://vehicletransportation.ca/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function import()
    {

        if (!\Auth::user()->is_admin)
        {
            return response('', 400);
        }

        return view('import');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function importPost(Request $request)
    {
        $check_pd_headers = 5;
        $check_pd_origin = 0;
        $check_pd_dealer = 7;

        $check_rail_headers = 5;
        $check_rail_origin = 0;
        $check_rail_days = 2;

        if (!\Auth::user()->is_admin)
        {
            return response('', 400);
        }

        $file = $request->file('file');

        try {
            \Excel::load($file->getPath() . '/' . $file->getFilename(), function ($reader) use ($request, $check_pd_headers, $check_pd_origin, $check_pd_dealer, $check_rail_headers, $check_rail_origin, $check_rail_days)
            {
                $sheet = $reader->sheet(0)->toArray();

                if (isset($sheet[$check_pd_headers]) && $sheet[$check_pd_headers][$check_pd_origin] === 'Origin' && $sheet[$check_pd_headers][$check_pd_dealer] === 'Dealer')
                {
                    if ($request->has('truncate'))
                    {
                        $deleted = RatesModel::where('type', 'pd')->delete();
                    }
                    $this->parsePickupDeliveryRates($sheet);
                }
                else if (isset($sheet[$check_rail_headers]) && $sheet[$check_rail_headers][$check_rail_origin] === 'Origin' && $sheet[$check_rail_headers][$check_rail_days] === 'Days')
                {
                    if ($request->has('truncate'))
                    {
                        $deleted = RatesModel::where('type', 'rail')->delete();
                    }
                    $this->parseRailRates($sheet);
                } else {
                    throw new \Exception('Bad File Format');
                     return response('Bad File Format', 422);
                }
            });
            return response('Imported', 200);
        }
        catch (\Exception $e)
        {
            return response($e->getMessage(), 403);
        }      
    }

    /**
     * @param $sheet
     */
    private function parsePickupDeliveryRates($sheet)
    {
        $start_at = 6;

        $col_origin = 0;
        $col_origin_prov = 1;
        $col_destination = 2;
        $col_destination_prov = 3;
        $col_is_local = 4;
        $col_type_private = 4;
        $col_type_mover = 5;
        $col_type_dealer = 6;

        $normalized = [];

        for ($i = $start_at; $i < count($sheet); $i++)
        {
            $data = [];

            $data['origin'] = $sheet[$i][$col_origin];
            $data['origin_province'] = $sheet[$i][$col_origin_prov];
            $data['destination'] = $sheet[$i][$col_destination];
            $data['destination_province'] = $sheet[$i][$col_destination_prov];
            $data['type'] = 'pd';

            if (!empty($data['origin']) && !empty($data['destination']))
            {
                $data['account_type'] = 'private';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_type_private])));
                $normalized[] = $data;

                $data['account_type'] = 'mover';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_type_mover])));
                $normalized[] = $data;

                $data['account_type'] = 'dealer';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_type_dealer])));
                $normalized[] = $data;
            }
        }

        foreach ($normalized as $rate)
        {
            $rateModel = RatesModel::firstOrCreate([
                'origin' => $rate['origin'],
                'origin_province' => $rate['origin_province'],
                'destination' => $rate['destination'],
                'destination_province' => $rate['destination_province'],
                'type' => $rate['type'],
                'account_type' => $rate['account_type'],
            ]);

            $rateModel->rate = $rate['rate'];

            $rateModel->save();
        }
    }

    /**
     * @param $sheet
     */
    private function parseRailRates($sheet)
    {
        $start_at = 5;

        $col_origin = 0;
        $col_destination = 1;
        $col_days = 2;

        $col_private_car = 3;
        $col_private_van = 4;
        $col_private_os = 5;

        $col_repeat_car = 6;
        $col_repeat_van = 7;
        $col_repeat_os = 8;

        $col_mover_car = 9;
        $col_mover_van = 10;
        $col_mover_os = 11;

        $col_dealer_car = 12;
        $col_dealer_van = 13;
        $col_dealer_os = 14;

        $normalized = [];

        for ($i = $start_at; $i < count($sheet); $i++)
        {
            $data = [];

            $data['origin'] = $sheet[$i][$col_origin];
            $data['destination'] = $sheet[$i][$col_destination];
            $data['est_days'] = $sheet[$i][$col_days];
            $data['type'] = 'rail';

            if (!empty($data['origin']) && !empty($data['destination']))
            {
                $data['account_type'] = 'private';
                $data['vehicle_type'] = 'car';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_private_car])));
                $normalized[] = $data;

                $data['account_type'] = 'private';
                $data['vehicle_type'] = 'van';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_private_van])));
                $normalized[] = $data;

                $data['account_type'] = 'private';
                $data['vehicle_type'] = 'os';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_private_os])));
                $normalized[] = $data;

                $data['account_type'] = 'repeat';
                $data['vehicle_type'] = 'car';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_repeat_car])));
                $normalized[] = $data;

                $data['account_type'] = 'repeat';
                $data['vehicle_type'] = 'van';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_repeat_van])));
                $normalized[] = $data;

                $data['account_type'] = 'repeat';
                $data['vehicle_type'] = 'os';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_repeat_os])));
                $normalized[] = $data;

                $data['account_type'] = 'mover';
                $data['vehicle_type'] = 'car';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_mover_car])));
                $normalized[] = $data;

                $data['account_type'] = 'mover';
                $data['vehicle_type'] = 'van';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_mover_van])));
                $normalized[] = $data;

                $data['account_type'] = 'mover';
                $data['vehicle_type'] = 'os';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_mover_os])));
                $normalized[] = $data;

                $data['account_type'] = 'dealer';
                $data['vehicle_type'] = 'car';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_dealer_car])));
                $normalized[] = $data;

                $data['account_type'] = 'dealer';
                $data['vehicle_type'] = 'van';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_dealer_van])));
                $normalized[] = $data;

                $data['account_type'] = 'dealer';
                $data['vehicle_type'] = 'os';
                $data['rate'] = floatval(trim(str_replace('$', '', $sheet[$i][$col_dealer_os])));
                $normalized[] = $data;
            }
        }

        foreach ($normalized as $rate)
        {
            $rateModel = RatesModel::firstOrCreate([
                'origin' => $rate['origin'],
                'destination' => $rate['destination'],
                'type' => $rate['type'],
                'vehicle_type' => $rate['vehicle_type'],
                'account_type' => $rate['account_type'],
            ]);

            $rateModel->est_days = floatval($rate['est_days']);
            $rateModel->rate = $rate['rate'];

            $rateModel->save();
        }
    }
}
