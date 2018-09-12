<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rates as RatesModel;
use App\Provinces as ProvincesModel;

class DropdownController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getCities(Request $request) {

        $rates = RatesModel::select('destination', 'destination_province');

        if ($request->has('term') && $request->get('term') !== 'undefined' && !empty($request->get('term')))
        {
            $rates->where('destination', 'LIKE', $request->get('term').'%')->groupBy('destination', 'destination_province');
        } else {
            $rates->groupBy('destination', 'destination_province');
        }

        if ( $request->has('local') && $request->get('local') !== "false" )
        {
            $rates->where('type', 'pd');
        }
        else
        {
            $rates->where('type', 'rail');
        }

        $rates = $rates->orderBy('destination_province', 'DESC')->get();

        $destinations = [];



        if (!count($rates))
        {
            $valid = false;
            $destinations[] = ['id' =>  $request->get('term'), 'text' =>  $request->get('term')];
        }
        else
        {
            $valid = true;
            foreach($rates as $rate)
            {
                $destinations[] = ['id' =>  $rate->destination, 'text' =>  $rate->destination, 'province'=>$rate->destination_province];
            }
        }


        return response()->json(['items'=>$destinations, 'valid'=>$valid]);
    }

    public function getProvince(Request $request) {

        $rates = ProvincesModel::select('name');

        if ($request->has('term') && $request->get('term') !== 'undefined' && !empty($request->get('term')))
        {
            $rates->where('name', 'LIKE', $request->get('term').'%')->groupBy('name');
        } else {
            $rates->groupBy('name')->limit(5);
        }

        $rates = $rates->get();

        $destinations = [];



        if (!count($rates))
        {
            $valid = false;
            $destinations[] = ['id' =>  $request->get('term'), 'text' =>  $request->get('term')];
        }
        else
        {
            $valid = true;
            foreach($rates as $rate)
            {
                $destinations[] = ['id' =>  $rate->name, 'text' =>  $rate->name];
            }
        }


        return response()->json(['items'=>$destinations, 'valid'=>$valid]);
    }


    public function getVehicleYears(Request $request) {

        $years = \DB::table('VT08_Year');

        if ($request->has('term') && $request->get('term') !== 'undefined')
            $years = $years->where('YearDesc', 'LIKE', $request->get('term').'%');

        $years = $years->orderBy('YearDesc', 'DESC')->get();

        if ($years)
            $years = $years->map(function($v) { return [ 'id' => $v->YearDesc, 'text' => $v->YearDesc]; });

        return response()->json($years);
    }

    public function getVehicleMakes(Request $request) {

        $makes = \DB::table('VT02_Division')->where('LngCode', 'EN');

        if ($request->has('term') && $request->get('term') !== 'undefined')
            $makes = $makes->where('DivDesc', 'LIKE', $request->get('term').'%');

        $makes = $makes->get();

        if ($makes)
            $makes = $makes->map(function($v) { return [ 'id' => $v->DivDesc, 'text' => $v->DivDesc]; });

        return response()->json($makes);
    }

    public function getVehicleModels(Request $request) {

        $models = \DB::table('VT04_Model')->where('LngCode', 'EN');

        if ($request->has('term') && $request->get('term') !== 'undefined')
            $models = $models->where('ModelDesc', 'LIKE', $request->get('term').'%');

        if ($request->has('make'))
        {
            $make = \DB::table('VT02_Division')->where('LngCode', 'EN')->where('DivDesc', $request->get('make'))->first();
            if ($make)
                $models->where('DivCode', $make->DivCode);
        }

        $models = $models->get();

        if ($models)
            $models = $models->map(function($v) { return [ 'id' => $v->ModelDesc, 'text' => $v->ModelDesc, 'model' => $v->ModelDesc, 'type' => $v->ModelType]; });

        return response()->json($models);
    }

}
