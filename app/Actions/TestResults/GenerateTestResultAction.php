<?php

namespace App\Actions\TestResults;

use App\Models\TestResult;
use App\Models\TestBooking;
use Illuminate\Support\Facades\DB;

class GenerateTestResultAction
{

    private TestResult $testResult;
    private ?array $mediaUrls;
    private ?string $customerEmail;

    public function run(int|TestBooking $testBooking) : TestResult
    {
        $testBookingId = $testBooking instanceof TestBooking ? $testBooking->id : $testBooking;
        $this->testResult = new TestResult;
        $this->testResult->test_booking_id = $testBookingId;
        $this->testResult->customer_email = $this->customerEmail;

        DB::transaction(function () {
            $this->testResult->save();
            if (!empty($this->mediaUrls)) {
                foreach ($this->mediaUrls as $url) {
                    $mediaUrl = asset($url);//storage_path('/public/'$url)
                    $this->testResult->addMediaFromUrl($mediaUrl)->preservingOriginal()->toMediaCollection('result');
                }

            }
        });

        return $this->testResult;
    }

    public function withMediaUrls(null|string|array $mediaUrls): self
    {
        $mediaUrls = is_string($mediaUrls) ? [$mediaUrls] : $mediaUrls;
        $this->mediaUrls = $mediaUrls;
        return $this;
    }

    public function withCustomerEmail(null|string $customerEmail): self
    {

        $this->customerEmail = $customerEmail;
        return $this;
    }
}
