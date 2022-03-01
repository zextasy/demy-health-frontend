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
        return view('frontend.covid19-pcr-testing');
    }

    public function allServices()
    {
        return view('frontend.services.all-services');
    }

    public function allProducts()
    {
        return view('frontend.products.all-products');
    }


    public function pcrAndReagents()
    {
        return view('frontend.pcr-and-reagents');
    }

    public function hospitalAndLaboratoryProducts()
    {
        return view('frontend.hospital-and-laboratory-products');
    }

    public function pharmaceuticals()
    {
        return view('frontend.pharmaceuticals');
    }

    public function procurementAndSupply()
    {
        return view('frontend.procurement-and-supply');
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
        return view('frontend.take-a-test');
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

    public function frontend()
    {
        return view('frontend.');
    }
}
