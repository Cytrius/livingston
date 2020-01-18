<?php

namespace App\Http\Controllers;

use App\Account as AccountModel;
use App\Http\Controllers\QuotesController;
use App\Quotes as QuotesModel;
use App\Rates as RatesModel;
use App\Settings as SettingsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    public function history()
    {

        $quotes = QuotesModel::where('account_id', \Auth::user()->account_id)->orderBy('created_at', 'DESC')->get();

        return view('history', ['user' => \Auth::user(), 'quotes' => $quotes]);
    }

    public function leadForm()
    {

        $origins = RatesModel::select('origin')->groupBy('origin')->get();

        $destinations = RatesModel::select('destination')->groupBy('destination')->get();

        return view('lead-form', [
            'origins' => $origins,
            'destinations' => $destinations,
            'user' => \Auth::user(),
            'account' => AccountModel::where('id', \Auth::user()->account_id)->first(),
        ]);
    }

    /**
     * @param $quote_id
     */
    public function book(Request $request, $quote_id = false)
    {

        if ($quote_id)
        {
            $quote = QuotesModel::where('id', $quote_id)->first();
        }
        else
        {
            $quote = null;
        }

        if ($request->has('alt') && $request->get('alt') === 'true')
        {
            $quote->origin_pickup = null;
            $quote->destination_delivery = null;

            $total = 0;

            $quote->origin_pickup_rate = 0;

            if ($quote->rate)
            {
                $total += $quote->rate;
            }

            $quote->destination_delivery_rate = 0;

            $fuel_surcharge = SettingsModel::where('setting', 'fuel_surcharge')->first();
            $quote->fuel_surcharge = floatval($fuel_surcharge->value);
            $quote->subtotal = $total + ($total * ($quote->fuel_surcharge / 100));

            $quote->tax_percent = $this->getTaxRate($quote->destination);
            $quote->total = $quote->subtotal + ($quote->subtotal * ($quote->tax_percent / 100));

            $quote->save();
        }

        if (is_null($quote->origin_pickup))
        {
            $origin_term = \DB::table('terminals')->where('term_city', $quote->origin)->first();
        }
        else
        {
            $origin_term = false;
        }

        if (is_null($quote->destination_delivery))
        {
            $dest_term = \DB::table('terminals')->where('term_city', $quote->destination)->first();
        }
        else
        {
            $dest_term = false;
        }

        return view('book', [
            'user' => \Auth::user(),
            'account' => AccountModel::where('id', \Auth::user()->account_id)->first(),
            'quote' => $quote,
            'origin_term' => $origin_term,
            'dest_term' => $dest_term,
        ]);
    }

    /**
     * @param $quote_id
     */
    public function bookConfirm(Request $request, $quote_id = false)
    {

        if ($quote_id)
        {
            $quote = QuotesModel::where('id', $quote_id)->first();

            $quote->is_booked = true;

            if ($request->has('origin_contact_name'))
            {
                $quote->origin_contact_name = $request->get('origin_contact_name');
            }

            if ($request->has('origin_contact_phone'))
            {
                $quote->origin_contact_phone = $request->get('origin_contact_phone');
            }

            if ($request->has('origin_contact_address'))
            {
                $quote->origin_contact_address = $request->get('origin_contact_address');
            }

            if ($request->has('dest_contact_name'))
            {
                $quote->dest_contact_name = $request->get('dest_contact_name');
            }

            if ($request->has('dest_contact_phone'))
            {
                $quote->dest_contact_phone = $request->get('dest_contact_phone');
            }

            if ($request->has('dest_contact_address'))
            {
                $quote->dest_contact_address = $request->get('dest_contact_address');
            }

            $quote->save();

            $quoteController = new QuotesController();
            $quoteController->notifyBooking($quote->id, false);

        }
        else
        {
            $quote = null;
        }

        return view('book-confirm', [
            'user' => \Auth::user(),
            'account' => AccountModel::where('id', \Auth::user()->account_id)->first(),
            'quote' => $quote,
        ]);
    }

    /**
     * @param Request $request
     */
    public function quote(Request $request)
    {

        $user = \Auth::user();
        $account = AccountModel::where('id', \Auth::user()->account_id)->first();
        $form = $request->all();

        if (isset($form['cb_vehicleType']))
        {
            switch ($form['cb_vehicleType'])
            {
                case 'car':$form['cb_vehicleType'] = 'car';
                    break;
                case 'van':$form['cb_vehicleType'] = 'van';
                    break;
                case 'suv':$form['cb_vehicleType'] = 'van';
                    break;
                case 'truck':$form['cb_vehicleType'] = 'os';
                    break;
                case 'os':$form['cb_vehicleType'] = 'os';
                    break;
                default:$form['cb_vehicleType'] = 'car';
                    break;
            }
        }
        else
        {
            $form['cb_vehicleType'] = 'car';
        }

        $new_quote = QuotesModel::create();

        $new_quote->account_id = $account->id;
        $new_quote->user_id = $user->id;
        $new_quote->departure_at = new Carbon($form['departureDate']);

        // Sort out pickup and origin hub
        $new_quote->origin_pickup = isset($form['cb_pickupRequired']) ? $form['cb_originCity'] : null;

        $origin_pd_rate = RatesModel::where('destination', $form['cb_originCity'])
            ->where('type', 'pd')
            ->where('account_type', $account->type)
            ->first();

        if (isset($form['cb_pickupRequired']))
        {
            if ($origin_pd_rate)
            {
                $new_quote->origin_pickup_rate = $origin_pd_rate->rate;
                $form['cb_pickupRequired'] = $form['cb_originCity'];
                $form['cb_originCity'] = $origin_pd_rate->origin;
            }
            else
            {
                $new_quote->origin_pickup_rate = null;
            }
        }
        else
        {
            if ($origin_pd_rate)
            {
                $new_quote->origin_pickup_rate = 0;
                $form['cb_originCity'] = $origin_pd_rate->origin;
            }
            else
            {
                $new_quote->origin_pickup_rate = null;
            }
        }

        $new_quote->origin = $form['cb_originCity'];

        // Sort out delivery and destination hub

        $new_quote->destination_delivery = isset($form['cb_deliveryRequired']) ? $form['cb_destCity'] : null;

        $dest_pd_rate = RatesModel::where('destination', $form['cb_destCity'])
            ->where('type', 'pd')
            ->where('account_type', $account->type)
            ->first();

        if (isset($form['cb_deliveryRequired']))
        {
            if ($dest_pd_rate)
            {
                $new_quote->destination_delivery_rate = $dest_pd_rate->rate;
                $form['cb_destCity'] = $dest_pd_rate->origin;
            }
            else
            {
                $new_quote->destination_delivery_rate = null;
            }
        }
        else
        {
            if ($dest_pd_rate)
            {
                $new_quote->destination_delivery_rate = 0;
                $form['cb_deliveryRequired'] = $form['cb_destCity'];
                $form['cb_destCity'] = $dest_pd_rate->origin;
            }
            else
            {
                $new_quote->destination_delivery_rate = null;
            }
        }

        $new_quote->destination = $form['cb_destCity'];

        // Get our rate for origin to destination via rail

        $rail_rate = RatesModel::where('origin', $new_quote->origin)
            ->where('destination', $new_quote->destination)
            ->where('type', 'rail')
            ->where('account_type', $account->type)
            ->where('vehicle_type', $form['cb_vehicleType'])
            ->first();

        if (!$rail_rate)
        {
            // No rates for this one
            $new_quote->rate = 0;
        }
        else
        {
            $new_quote->rate = $rail_rate->rate;
        }

        $new_quote->vehicle_type = $form['cb_vehicleType'];
        $new_quote->vehicle_year = $form['cb_vehicleYear'];
        $new_quote->vehicle_make = $form['cb_vehicleMake'];
        $new_quote->vehicle_model = $form['cb_vehicleModel'];

        $new_quote->form_origin_city = $form['cb_originCity'];

        if (isset($form['cb_originProvince']))
        {
            $new_quote->form_origin_province = $form['cb_originProvince'];
        }

        if (isset($form['cb_originPostalCode']))
        {
            $new_quote->form_origin_postal = $form['cb_originPostalCode'];
        }

        $new_quote->form_destination_city = $form['cb_destCity'];

        if (isset($form['cb_destProvince']))
        {
            $new_quote->form_destination_province = $form['cb_destProvince'];
        }

        if (isset($form['cb_destPostalCode']))
        {
            $new_quote->form_destination_postal = $form['cb_destPostalCode'];
        }

        $new_quote->form_email = $form['contact_email'];
        $new_quote->form_first_name = $form['contact_first_name'];
        $new_quote->form_last_name = $form['contact_last_name'];
        $new_quote->form_phone = $form['contact_business_phone'];
        $new_quote->form_company = $form['contact_company'];
        $new_quote->form_address = $form['contact_address'];
        $new_quote->form_city = $form['contact_city'];

        $total = 0;

        if ($new_quote->origin_pickup_rate)
        {
            $total += $new_quote->origin_pickup_rate;
        }

        if ($new_quote->rate)
        {
            $total += $new_quote->rate;
        }

        if ($new_quote->destination_delivery_rate)
        {
            $total += $new_quote->destination_delivery_rate;
        }

        $fuel_surcharge = SettingsModel::where('setting', 'fuel_surcharge')->first();
        $new_quote->fuel_surcharge = floatval($fuel_surcharge->value);
        $new_quote->subtotal = $total + ($total * ($new_quote->fuel_surcharge / 100));

        $new_quote->tax_percent = $this->getTaxRate($new_quote->destination);
        $new_quote->total = $new_quote->subtotal + ($new_quote->subtotal * ($new_quote->tax_percent / 100));

        if ($new_quote->origin_pickup_rate > 0)
        {
            // Alternative
            $alt_total = 0;
            if ($new_quote->rate)
            {
                $alt_total += $new_quote->rate;
            }

            $alt_total = $alt_total + ($alt_total * ($new_quote->fuel_surcharge / 100));
            $new_quote->alt_subtotal = $alt_total;
            $new_quote->alt_total = $alt_total + ($alt_total * ($new_quote->tax_percent / 100));
        }

        if ($rail_rate)
        {
            $new_quote->est_days = $rail_rate->est_days;
        }
        else
        {
            $new_quote->est_days = 0;
        }

        $new_quote->save();

        $quoteController = new QuotesController();
        $quoteController->notifyQuote($new_quote->id, false);

        return view('quote', [
            'quote' => $new_quote,
            'user' => \Auth::user(),
            'account' => AccountModel::where('id', \Auth::user()->account_id)->first(),
            'form' => $request->all(),
        ]);
    }

    /**
     * @param $destination
     * @return int
     */
    public function getTaxRate($destination)
    {
        $destination = RatesModel::where('destination', 'LIKE', $destination . '%')->where('type', 'pd')->first();

        if (!$destination)
        {
            return 0;
        }

        $province = strtolower($destination->destination_province);

        $tax_rate = SettingsModel::where('setting', 'tax_' . $province)->first();

        if (!$tax_rate)
        {
            return 0;
        }

        return floatval($tax_rate->value);

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {

        $directory = base_path() . '/public/dist';

        try {
            $files = array_diff(scandir($directory), array('..', '.'));
        }
        catch (\Exception $e)
        {
            throw new \Exception('No bundled application exists in the public directory');
        }

        $assets = [];

        foreach ($files as $file)
        {
            if (strpos($file, 'app') !== false && strpos($file, 'map') == false)
            {
                $assets['app'] = $file;
            }

            if (strpos($file, 'vendor') !== false && strpos($file, 'map') == false)
            {
                $assets['vendor'] = $file;
            }

            if (strpos($file, 'polyfill') !== false && strpos($file, 'map') == false)
            {
                $assets['polyfill'] = $file;
            }

        }
        return view('dashboard', ['assets' => $assets, 'user' => \Auth::user()->toArray()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!\Auth::user()->is_admin)
        {
            return response('', 400);
        }

        $directory = base_path() . '/public/dist';

        try {
            $files = array_diff(scandir($directory), array('..', '.'));
        }
        catch (\Exception $e)
        {
            throw new \Exception('No bundled application exists in the public directory');
        }

        $assets = [];

        foreach ($files as $file)
        {
            if (strpos($file, 'app') !== false && strpos($file, 'map') == false)
            {
                $assets['app'] = $file;
            }

            if (strpos($file, 'vendor') !== false && strpos($file, 'map') == false)
            {
                $assets['vendor'] = $file;
            }

            if (strpos($file, 'polyfill') !== false && strpos($file, 'map') == false)
            {
                $assets['polyfill'] = $file;
            }

        }

        return view('dashboard', ['assets' => $assets]);
    }
}
