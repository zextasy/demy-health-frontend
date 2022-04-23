<?php

namespace Database\Seeders;

use App\Models\TestType;
use App\Models\TestCategory;
use App\Models\SpecimenType;
use Illuminate\Database\Seeder;

class TestCategorySeeder2 extends Seeder
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
        $testCategory = TestCategory::create(['name' => 'HIV AND ASSOCIATED DISEASES BY PCR METHOD']);
        $test = new TestType;
        $test->test_id = 'GTL 014';
        $test->description = 'HIV RNA QUANTITATIVE DETECTION(VIRAL LOAD)';
        $test->minimum_tat = 2;
        $test->price = 20000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 015';
        $test->description = 'HIV RNA DETECTION';
        $test->minimum_tat = 2;
        $test->price = 15000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 016';
        $test->description = 'HYPERSENSITIVITY REACTION TO ANTIRETROVIRAL DRUG';
        $test->minimum_tat = 14;
        $test->price = 30000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 017';
        $test->description = 'PNEUMOCYSTIS JIROVECII (CARINII) DETECTION';
        $test->minimum_tat = 14;
        $test->price = 20000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 018';
        $test->description = 'CRYPTOCOCCUS NEOFORMANS DETECTION';
        $test->minimum_tat = 14;
        $test->price = 25000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 019';
        $test->description = 'HIV DNA DETECTION';
        $test->minimum_tat = 5;
        $test->price = 30000;
        $test->maximum_tat = 9;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 020';
        $test->description = 'HIV DRUG RESISTANT (HIV GENOTYPE/ DRUG RESISTANCE) ASSAY';
        $test->minimum_tat = 5;
        $test->price = 55000;
        $test->maximum_tat = 9;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL O21';
        $test->description = 'CRYPTOCOCCUS NEOFORMANS DETECTION';
        $test->minimum_tat = 14;
        $test->price = 25000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $testCategory = TestCategory::create(['name' => 'INFECTIOUS DISEASES BY PCR METHOD (MULTIPLEX)']);
        $test = new TestType;
        $test->test_id = 'GTL 022';
        $test->description = 'HBV/HDV REAL-TIME PCR TEST FOR SIMULTANEOUS DETECTION OF HBV AND HDV';
        $test->minimum_tat = 2;
        $test->price = 20000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 023';
        $test->description = 'HBV/HCV/HIV1/HIV2 REAL-TIME PCR DETECTION';
        $test->minimum_tat = 10;
        $test->price = 50000;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 024';
        $test->description = 'HBV/HCV/HIV REAL TIME DETECTION';
        $test->minimum_tat = 10;
        $test->price = 30000;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $testCategory = TestCategory::create(['name' => 'COVID-19 BY PCR METHOD']);
        $test = new TestType;
        $test->test_id = 'GTL CV01';
        $test->description = 'COVID – 19 DETECTION (NON TRAVELLERS)';
        $test->minimum_tat = 1;
        $test->price = 25000;
        $test->maximum_tat = 1;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);

        $test = new TestType;
        $test->test_id = 'GTL 026';
        $test->description = 'HPV DNA DETECTION/GENOTYPING TYPE 16 & 18';
        $test->minimum_tat = 5;
        $test->price = 10000;
        $test->maximum_tat = 5;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);

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
    }
}

//$test = new TestType;
//$test->test_id = '';
//$test->description = '';
//$test->minimum_tat = 0;
//$test->maximum_tat = 0;
//$test->price = 0;
//$test->test_category_id = $testCategory->id;
//$test->save();
//$test->specimenTypes()->save($specimenTypeSW);
