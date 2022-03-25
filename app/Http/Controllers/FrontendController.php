<?php

namespace App\Http\Controllers;

use App\Models\TestType;
use App\Models\TestCenter;
use Illuminate\Http\Request;
use App\Models\TestCategory;

class FrontendController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function covid19PCRTesting()
    {
        return view('frontend.covid19-pcr-testing');
    }

    public function allServices()
    {
        return view('frontend.services.all-services');
    }




    public function pcrDiagResearch()
    {
        return view('frontend.pcr-diag-research');
    }

    public function biomedicalEngineering()
    {
        return view('frontend.biomedical-engineering');
    }

    public function sequencingAndBiorepositoryServices()
    {
        return view('frontend.sequencing-and-biorepository-services');
    }

    public function molecularBiologyTraining()
    {
        return view('frontend.molecular-biology-training');
    }

    public function setUpYourLab()
    {
        return view('frontend.set-up-your-lab');
    }

    public function TakeATest()
    {
//        $data['testCenters'] = TestCenter::all();
//        $data['testCategories'] = TestCategory::all();
//        $data['testTypes'] = TestType::all();
        return view('frontend.take-a-test'); //, $data
    }

    public function TestResults()
    {
        return view('frontend.test-results');
    }

    public function placeholder()
    {
        return view('frontend.');
    }

    public function aboutUs()
    {
        return view('frontend.about-us');
    }

    public function ourTeam()
    {
        return view('frontend.our-team');
    }

    public function missionStatement()
    {
        return view('frontend.mission-statement');
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }

    public function frontend()
    {
        return view('frontend.');
    }

    public function bookATest(){
        flash()->message('Your test has been booked.','success');
        return redirect('index.html');
//        return redirect()->action('FrontendController@home');
    }
}
