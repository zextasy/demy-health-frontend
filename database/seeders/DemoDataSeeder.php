<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BusinessGroup;
use Illuminate\Database\Seeder;
use App\Models\TestResultTemplate;

class DemoDataSeeder extends Seeder
{

    public function run()
    {
        if (BusinessGroup::whereNotNull('parent_id')->doesntExist()) {
            $this->call(DatabaseSeeder::class);
        }
        $this->call(BusinessGroupSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TestCenterSeeder::class);
        $this->call(SpecimenTypeSeeder::class);
        $this->call(TestCategorySeeder::class);
        $this->call(VirtualFieldSeeder::class);
        $this->call(TestResultTemplateSeeder::class);
        $this->call(TestTypeSeeder::class);
        $this->call(TestBookingSeeder::class);
        $this->call(TestResultSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(InvoiceSeeder::class);

    }
}
