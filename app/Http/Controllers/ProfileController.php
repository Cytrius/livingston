<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;
use App\Profile;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getProfile($id)
    {
        $profile = Profile::where('id', $id)->first();

        return response()->json($profile, 200);
    }

    public function getProfiles(Request $request)
    {
        $profiles = Profile::select('*');

        if ($request->has('query')) {
            // Apply search term
            $q = explode(' ', strtolower($request->get('query')));
            $q = implode($q, '|');

            $profiles->where('name', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('title', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('company', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('keywords', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('company_size', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('industry', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('influence_role', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('daily_life', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('demographic', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('goals', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('story', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('objections', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('skills', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('red_flags', 'regexp',  '.*'.$q.'.*');
            $profiles->orWhere('colleagues', 'regexp',  '.*'.$q.'.*');

        }

        $all_count = $profiles->count();

        if ($request->has('page') && $request->has('limit')) {
            $profiles->offset(($request->get('page')-1)*$request->get('limit'));
            $profiles->limit($request->get('limit'));
        }

        $profiles = $profiles->get();

        $result = [
            'profiles' => $profiles,
            'count' => count($profiles),
            'all_count' => $all_count,
            'from' => (($request->get('page')-1)*$request->get('limit'))+1,
            'to' => (($request->get('page')-1)*$request->get('limit'))+count($profiles)
        ];

        return response()->json($result, 200);
    }

    /**
     * Save profile
     *
     * @return \Illuminate\Http\Response
     */
    public function saveProfile(Request $request, $id=null) {

        if ($id)
            $profile = Profile::where('id', $id)->first();
        else
            $profile = Profile::create();

        if (!$profile)
            return response()->json(['error' => 'Not found'], 404);

        if (!$profile->update($request->all()))
            return response()->json(['error' => 'Couldnt update'], 500);

        return response()->json($profile, 200);

    }

    /**
     * Save profile
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProfile(Request $request, $id) {

        $profile = Profile::where('id', $id)->first();

        if (!$profile)
            return response()->json(['error' => 'Not found'], 404);

        if (!$profile->delete())
            return response()->json(['error' => 'Couldnt delete'], 500);

        return response()->json([], 200);

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function newProfile(Request $request)
    {
        $profile = Profile::create();

        if (!$profile)
            response()->json(['error'=>'profile not created'], 500);

        // Profile parse
        if ($request->has('profile')) {
            
            $profileDom = $request->get('profile');

            $dom = new Dom;
            $dom->load($profileDom);

            try {

                if (isset($dom->find('h1.pv-top-card-section__name')[0]))
                    $name = $dom->find('h1.pv-top-card-section__name')[0]->text;

                if (isset($dom->find('img.pv-top-card-section__image')[0]))
                    $photo = $dom->find('img.pv-top-card-section__image')[0]->src;

                if (!isset($photo))
                    if (isset($dom->find('img.profile-photo-edit__preview')[0]))
                         $photo = $dom->find('img.profile-photo-edit__preview')[0]->src;

                if (isset($dom->find('h2.pv-top-card-section__headline')[0]))
                    $title = $dom->find('h2.pv-top-card-section__headline')[0]->text;

                if (isset($dom->find('h3.pv-top-card-section__company')[0]))
                    $company = $dom->find('h3.pv-top-card-section__company')[0]->text;

                if (isset($dom->find('h3.pv-top-card-section__location')[0]))
                    $location = $dom->find('h3.pv-top-card-section__location')[0]->text;

                if (isset($dom->find('span.pv-skill-entity__skill-name')[0]))
                    $skills = $dom->find('span.pv-skill-entity__skill-name');

                $skillsArray = [];
                if (isset($skills))
                    foreach($skills as $key=>$val) {
                        if (count($skillsArray) < 10)
                        $skillsArray[] = $val->text;
                    }
                $skillsArray = implode(',', $skillsArray);

            } catch(\Exception $e) {
                return response()->json(['id'=>$e->getMessage(), 'line'=>$e->getLine()], 200);
            }
        }

        // Company parse
        if ($request->has('company')) {
            
            $companyDom = $request->get('company');

            $dom = new Dom;
            $dom->load($companyDom);

            try {

                if (isset($dom->find('span.company-industries')[0]))
                    $industry = $dom->find('span.company-industries')[0]->text;

                if (isset($dom->find('span.company-size')[0]))
                    $company_size = $dom->find('span.company-size')[0]->text;

                if (isset($company_size) && strpos($company_size, '-') !== false) {
                    $company_size = explode('-', $company_size)[1];
                    $company_size = explode(' ', $company_size)[0];
                    $company_size = intval($company_size);
                }

                if (isset($company_size) && strpos($company_size, '+') !== false) {
                    $company_size = str_replace(',', '', explode('+', $company_size)[0]);
                    $company_size = intval($company_size);
                }

            } catch(\Exception $e) {
                return response()->json(['id'=>$e->getMessage(), 'line'=>$e->getLine()], 200);
            }

        }  

        $profile->name = $name ?? null;
        $profile->title = $title ?? null;
        $profile->photo = $photo ?? null;
        $profile->company = $company ?? null;
        $profile->company_size = $company_size ?? null;
        $profile->industry = $industry?? null;
        $profile->skills = $skillsArray ?? null;

        $profile->save();

        return response()->json(['id'=>$profile->id, 'profile'=>$profile], 200);
    }
}