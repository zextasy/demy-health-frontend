<?php

namespace Database\Seeders;

use App\Models\TestType;
use App\Models\SpecimenType;
use App\Models\TestCategory;
use Illuminate\Database\Seeder;

class TestCategorySeeder3 extends Seeder
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

        $testCategory = TestCategory::create(['name' => 'HUMAN PAPILLOMA VIRUS BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 027';
        $test->description = 'HPV DNA QUANTITATIVE DETECTION& GENOTYPING OF 12 HIGH RISK (F7 & F9 GROUP)';
        $test->minimum_tat = 5;
        $test->price = 30000;
        $test->maximum_tat = 5;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);

        $test = new TestType;
        $test->test_id = 'GTL 028';
        $test->description = 'HPV DNA GENOTYPING OF 14 HIGH RISK';
        $test->minimum_tat = 10;
        $test->price = 30000;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);

        $test = new TestType;
        $test->test_id = 'GTL 029';
        $test->description = 'HPV DNA SCREENING OF ALL HIGH RISK & LOW RISK';
        $test->price = 25000;
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);

        $testCategory = TestCategory::create(['name' => 'ONCOHAEMATOLOGY BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 030';
        $test->description = 'BCR-ABL 1 TRANSCRIPT (P210)';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->price = 29000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 031';
        $test->description = 'BCR-ABL 1 TRANSCRIPT (P190)';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->price = 35000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 032';
        $test->description = 'JAK2 V617F MUTATION';
        $test->minimum_tat = 10;
        $test->maximum_tat = 10;
        $test->price = 35000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 033';
        $test->description = 'JAK2 EXON 12 MUTATION';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->price = 60000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 034';
        $test->description = 'JAK 2 V617F REFLEX TO JAK 2 TIONDETECTIONEXON 12, MUTATION DETECTION';
        $test->minimum_tat = 21;
        $test->maximum_tat = 21;
        $test->price = 75000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 035';
        $test->description = 'JAK 2 V617F, CALR & MPL, MUTATION DETECTION PROFILE';
        $test->minimum_tat = 0;
        $test->maximum_tat = 0;
        $test->price = 100000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $testCategory = TestCategory::create(['name' => 'TRANSPLANT/REJECTION BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 036';
        $test->description = 'HLA TYPING (SSP-PCR DNA METHOD) LOW/HIGH RESOLUTION DQB1 LOCUS';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->price = 110000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 037';
        $test->description = 'JCV/BKV VIRUS QUANTITATIVE DETECTION';
        $test->minimum_tat = 10;
        $test->maximum_tat = 10;
        $test->price = 40000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
    }
}
