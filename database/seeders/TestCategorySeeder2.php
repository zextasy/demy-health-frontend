<?php

namespace Database\Seeders;

use App\Models\SpecimenType;
use App\Models\TestCategory;
use App\Models\TestType;
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
        $test->name = 'HIV RNA QUANTITATIVE DETECTION(VIRAL LOAD)';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 015';
        $test->name = 'HIV RNA DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);

        $test = new TestType;
        $test->test_id = 'GTL 016';
        $test->name = 'HYPERSENSITIVITY REACTION TO ANTIRETROVIRAL DRUG';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(30000);

        $test = new TestType;
        $test->test_id = 'GTL 017';
        $test->name = 'PNEUMOCYSTIS JIROVECII (CARINII) DETECTION';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 018';
        $test->name = 'CRYPTOCOCCUS NEOFORMANS DETECTION';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(25000);

        $test = new TestType;
        $test->test_id = 'GTL 019';
        $test->name = 'HIV DNA DETECTION';
        $test->minimum_tat = 5;
        $test->maximum_tat = 9;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(30000);

        $test = new TestType;
        $test->test_id = 'GTL 020';
        $test->name = 'HIV DRUG RESISTANT (HIV GENOTYPE/ DRUG RESISTANCE) ASSAY';
        $test->minimum_tat = 5;
        $test->maximum_tat = 9;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(55000);

        $test = new TestType;
        $test->test_id = 'GTL O21';
        $test->name = 'CRYPTOCOCCUS NEOFORMANS DETECTION 2';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(25000);

        $testCategory = TestCategory::create(['name' => 'INFECTIOUS DISEASES BY PCR METHOD (MULTIPLEX)']);

        $test = new TestType;
        $test->test_id = 'GTL 022';
        $test->name = 'HBV/HDV REAL-TIME PCR TEST FOR SIMULTANEOUS DETECTION OF HBV AND HDV';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 023';
        $test->name = 'HBV/HCV/HIV1/HIV2 REAL-TIME PCR DETECTION';
        $test->minimum_tat = 10;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(50000);

        $test = new TestType;
        $test->test_id = 'GTL 024';
        $test->name = 'HBV/HCV/HIV REAL TIME DETECTION';
        $test->minimum_tat = 10;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(30000);

        $testCategory = TestCategory::create(['name' => 'COVID-19 BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL CV01';
        $test->name = 'COVID – 19 DETECTION (NON TRAVELLERS)';
        $test->minimum_tat = 1;
        $test->maximum_tat = 1;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
        $test->setPrice(25000);

        $test = new TestType;
        $test->test_id = 'GTL CV02';
        $test->name = 'COVID-19 DETECTION (TRAVELLERS)';
        $test->minimum_tat = 1;
        $test->maximum_tat = 1;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
        $test->setPrice(30000);
    }
}
