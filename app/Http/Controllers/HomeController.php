<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPHtmlParser\Dom;

use App\Account as AccountModel;

class HomeController extends Controller
{

    private $parent_site = 'http://vehicletransportation.ca/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }

    public function leadForm() {

        return view('lead-form', [
            'user' => \Auth::user(),
            'account' => AccountModel::where('id', \Auth::user()->account_id)->first()
        ]);
    }

    public function quote(Request $request) {

        return view('quote', [
            'user' => \Auth::user(),
            'account' => AccountModel::where('id', \Auth::user()->account_id)->first(),
            'form' => $request->all()
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $directory = base_path().'/public/dist';

        try {
            $files = array_diff(scandir($directory), array('..', '.'));
        } catch(\Exception $e) {
            throw new \Exception('No bundled application exists in the public directory');
        }

        $assets = [];

        foreach($files as $file) {
            if (strpos($file, 'app') !== false && strpos($file, 'map') == false)
                $assets['app'] = $file;

            if (strpos($file, 'vendor') !== false && strpos($file, 'map') == false)
                $assets['vendor'] = $file;

            if (strpos($file, 'polyfill') !== false && strpos($file, 'map') == false)
                $assets['polyfill'] = $file;
        }

        return view('dashboard', ['assets' => $assets]);
    }
}
