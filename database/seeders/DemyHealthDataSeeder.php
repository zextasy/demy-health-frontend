<?php

namespace Database\Seeders;

use App\Models\BusinessGroup;
use Illuminate\Database\Seeder;
use Database\Seeders\Demy\DemyUserSeeder;
use Database\Seeders\Demy\DemyProductSeeder;
use Database\Seeders\Demy\DemyTestTypeSeeder;
use Database\Seeders\Demy\DemyTestCenterSeeder;
use Database\Seeders\Demy\DemyReferralChannelSeeder;
use Database\Seeders\Demy\DemyProductCategorySeeder;

class DemyHealthDataSeeder extends Seeder
{
    const DEFAULT_PASSWORD = '123456';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (BusinessGroup::whereNotNull('parent_id')->doesntExist()) {
            $this->call(DatabaseSeeder::class);
        }
        $this->call(DemyUserSeeder::class);
        $this->call(DemyReferralChannelSeeder::class);
        $this->call(DemyTestCenterSeeder::class);
        $this->call(DemyProductCategorySeeder::class);
        $this->call(DemyProductSeeder::class);
        $this->call(DemyTestTypeSeeder::class);
    }
}
