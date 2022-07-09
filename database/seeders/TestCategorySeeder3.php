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
        $test->test_id = 'GTL 026';
        $test->name = 'HPV DNA DETECTION/GENOTYPING TYPE 16 & 18';
        $test->minimum_tat = 5;
        $test->maximum_tat = 5;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
        $test->setPrice(10000);

        $test = new TestType;
        $test->test_id = 'GTL 027';
        $test->name = 'HPV DNA QUANTITATIVE DETECTION& GENOTYPING OF 12 HIGH RISK (F7 & F9 GROUP)';
        $test->minimum_tat = 5;
        $test->maximum_tat = 5;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
        $test->setPrice(30000);

        $test = new TestType;
        $test->test_id = 'GTL 028';
        $test->name = 'HPV DNA GENOTYPING OF 14 HIGH RISK';
        $test->minimum_tat = 10;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
        $test->setPrice(30000);

        $test = new TestType;
        $test->test_id = 'GTL 029';
        $test->name = 'HPV DNA SCREENING OF ALL HIGH RISK & LOW RISK';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->setPrice(25000);
        $test->specimenTypes()->save($specimenTypeSW);

        $testCategory = TestCategory::create(['name' => 'ONCOHAEMATOLOGY BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 030';
        $test->name = 'BCR-ABL 1 TRANSCRIPT (P210)';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(29000);

        $test = new TestType;
        $test->test_id = 'GTL 031';
        $test->name = 'BCR-ABL 1 TRANSCRIPT (P190)';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(35000);

        $test = new TestType;
        $test->test_id = 'GTL 032';
        $test->name = 'JAK2 V617F MUTATION';
        $test->minimum_tat = 10;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(35000);

        $test = new TestType;
        $test->test_id = 'GTL 033';
        $test->name = 'JAK2 EXON 12 MUTATION';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(60000);

        $test = new TestType;
        $test->test_id = 'GTL 034';
        $test->name = 'JAK 2 V617F REFLEX TO JAK 2 TIONDETECTIONEXON 12, MUTATION DETECTION';
        $test->minimum_tat = 21;
        $test->maximum_tat = 21;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(75000);

        $test = new TestType;
        $test->test_id = 'GTL 035';
        $test->name = 'JAK 2 V617F, CALR & MPL, MUTATION DETECTION PROFILE';
        $test->minimum_tat = 0;
        $test->maximum_tat = 0;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(100000);

        $testCategory = TestCategory::create(['name' => 'TRANSPLANT/REJECTION BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 036';
        $test->name = 'HLA TYPING (SSP-PCR DNA METHOD) LOW/HIGH RESOLUTION DQB1 LOCUS';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(10000);

        $test = new TestType;
        $test->test_id = 'GTL 037';
        $test->name = 'JCV/BKV VIRUS QUANTITATIVE DETECTION';
        $test->minimum_tat = 10;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(40000);
    }
}
