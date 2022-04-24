<?php

namespace Database\Seeders;

use App\Models\TestType;
use App\Models\SpecimenType;
use App\Models\TestCategory;
use Illuminate\Database\Seeder;

class TestCategorySeeder8 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specimenTypeP = SpecimenType::where('key', 'P')->first();
        $specimenTypeSW = SpecimenType::where('key', 'SW')->first();
        $specimenTypeG = SpecimenType::where('key', 'G')->first();

        $testCategory = TestCategory::create(['name' => '']);

        $test = new TestType;
        $test->test_id = '';
        $test->description = '';
        $test->minimum_tat = 0;
        $test->maximum_tat = 0;
        $test->price = 0.0;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
    }

    private function getTest(string $prefix, $testCategory, string $testId, string $description, int $minTAT, int $maxTAT, float $price): TestType
    {
        $test = new TestType;
        $test->test_id = "GTL {$prefix} {$testId}";
        $test->description = $description;
        $test->minimum_tat = $minTAT;
        $test->maximum_tat = $maxTAT;
        $test->price = $price;
        $test->test_category_id = $testCategory->id;
        $test->save();

        return $test;
    }
}
