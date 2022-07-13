<?php

namespace Database\Seeders;

use App\Models\ReferralChannel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralChannelSeeder extends Seeder
{
    private $channels = [
        'Facebook',
        'Instagram',
        'Twitter',
        'WhatsApp',
        'Email',
        'www.demyhealth.com',
        'Flyer',
        'Word of mouth',
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
