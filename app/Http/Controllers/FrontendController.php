<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Patient;
use App\Models\TestBooking;
use App\Models\TestCategory;
use App\Models\TestCenter;
use App\Models\TestResult;
use App\Models\TestType;

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

    public function covid19RapidAntigenTesting()
    {
        return view('frontend.covid-19-rapid-antigen-testing');
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

    public function takeATest()
    {
        //        $data['testCenters'] = TestCenter::all();
        //        $data['testCategories'] = TestCategory::all();
        //        $data['testTypes'] = TestType::all();
        return view('frontend.take-a-test'); //, $data
    }

    public function placeholder()
    {
        return view('frontend.placeholder');
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

    public function myTestResults()
    {
        return view('frontend.my-test-results');
    }

    public function myUpcomingTestBookings()
    {
        return view('frontend.my-upcoming-test-bookings');
    }

    public function myOrders()
    {
        return view('frontend.my-orders');
    }

    public function listTestResults(string $customerIdentifier)
    {
        $patient = Patient::withCustomerDetails($customerIdentifier)->firstOrFail();
        $data['patient'] = $patient;

        return redirect()->back(); //TODO not implemented till discussion with doc about security
    }

    public function listUpcomingTestBookings(string $customerIdentifier)
    {
        $patient = Patient::withCustomerDetails($customerIdentifier)->firstOrFail();
        $data['patient'] = $patient;

        return view('frontend.list-upcoming-test-bookings', $data);
    }

    public function listOrders()
    {
        return view('frontend.list-orders');
    }

    public function viewTestBooking(int $id)
    {
        $testBooking = TestBooking::findOrFail($id);
        $data['testBooking'] = $testBooking;

        return view('frontend.test-booking-detail', $data);
    }

    public function viewTestResult(int $id)
    {
        $testResult = TestResult::findOrFail($id);
        $data['testResult'] = $testResult;

        return view('frontend.test-result-detail', $data);
    }

    public function ViewOrder(int $id)
    {
        $order = Order::findOrFail($id);
        $data['order'] = $order;

        return view('frontend.order-detail', $data);
    }

    public function frontend()
    {
        return view('frontend.base');
    }
}
