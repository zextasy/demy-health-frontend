<?php

namespace App\Actions\TestResults;

use App\Models\TestResult;
use App\Models\TestBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $this->testResult->has_media_upload = true;

        DB::transaction(function () {
            $this->testResult->save();
            if (!empty($this->mediaUrls)) {
                foreach ($this->mediaUrls as $url) {
                    $mediaUrl = asset($url);//
                    $mediaStoragePath = base_path('public/storage/'.$url);
                    if (file_exists($mediaStoragePath)) {
                        $this->testResult->copyMedia($mediaStoragePath)->preservingOriginal()
                            ->toMediaCollection('result');
                        break;
                    }

                    try {
                        $response = Http::get($mediaUrl);
                        if ($response->successful()) {
                            $this->testResult->addMediaFromUrl($mediaUrl)->preservingOriginal()
                                ->toMediaCollection('result');
                            break;
                        }
                    } catch (\Exception $e) {
                        break;
                    }


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
