<?php

namespace Database\Seeders\Demy;

use App\Models\ReferralChannel;
use Illuminate\Database\Seeder;

class DemyReferralChannelSeeder extends Seeder
{
    private $channels = [
        'www.demyhealth.com',
    ];

    public function run()
    {
        foreach ($this->channels as $channel) {
            ReferralChannel::create([
                'name' => $channel,
            ]);
        }
    }
}
