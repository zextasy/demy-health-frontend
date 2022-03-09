<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\StoreTestCenterRequest;
use App\Http\Requests\UpdateTestCenterRequest;
use App\Models\TestCenter;

class TestCenterController extends Controller
{
    public function index(): Response
    {
        //
    }

    public function show(TestCenter $testCenter): Response
    {
        //
    }

}
