<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPHtmlParser\Dom;

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
        
    }

    public function leadForm() {
        return view('welcome', [

        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        
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
