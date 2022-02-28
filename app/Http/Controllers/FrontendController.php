<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function covid19PCRTesting()
    {
        return view('content.covid-19-pcr-testing');
    }

    public function allServices()
    {
        return view('content.services.all-services');
    }

    public function labTests()
    {
        return view('welcome');
    }

    public function revolutionaryPanelTesting()
    {
        return view('welcome');
    }

    public function molecularDiagnosis()
    {
        return view('welcome');
    }

    public function portfolio()
    {
        return view('welcome');
    }

    public function aboutUs()
    {
        return view('welcome');
    }

    public function ourTeam()
    {
        return view('welcome');
    }

    public function missionStatement()
    {
        return view('welcome');
    }

    public function contactUs()
    {
        return view('welcome');
    }
}
