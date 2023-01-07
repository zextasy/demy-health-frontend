<?php

namespace Database\Seeders\Master;

use App\Models\ReferralChannel;
use Illuminate\Database\Seeder;

class MasterReferralChannelSeeder extends Seeder
{
    private $channels = [
        'Facebook',
        'Instagram',
        'Twitter',
        'WhatsApp',
        'Email',
        'Flyer',
        'Word of mouth',
    ];

    public function run()
    {
        foreach ($this->channels as $channel) {
            ReferralChannel::firstOrCreate([
                'name' => $channel,
            ]);
        }
    }
}
