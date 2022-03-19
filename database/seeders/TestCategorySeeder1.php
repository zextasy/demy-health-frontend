<?php

namespace Database\Seeders;

use App\Models\TestType;
use App\Models\TestCategory;
use App\Models\SpecimenType;
use Illuminate\Database\Seeder;

class TestCategorySeeder1 extends Seeder
{
    private $categoryTests = [

    ];

    public function run()
    {
        $testCategory = TestCategory::create(['name' => 'HEPATITIS BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 001';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS A DNA DETECTION';
        $test->minimum_tat = 5;
        $test->price = 10000;
        $test->maximum_tat = 7;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 002';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS B DNA QUANTITATIVE DETECTION (VIRAL LOAD)';
        $test->minimum_tat = 1;
        $test->price = 20000;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 003';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS B DNA DETECTION';
        $test->minimum_tat = 1;
        $test->price = 15000;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 004';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS B GENOTYPE DNA';
        $test->minimum_tat = 10;
        $test->price = 25000;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 005';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS C RNA QUANTITATIVE DETECTION (VIRAL LOAD)';
        $test->minimum_tat = 2;
        $test->price = 23000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 006';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS C RNA DETECTION';
        $test->minimum_tat = 2;
        $test->price = 17000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 007';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HCV GENOTYPE (DETECTION OF 7 GENOTYPES)';
        $test->minimum_tat = 3;
        $test->price = 30000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 008';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HCV RESISTANT TESTING';
        $test->minimum_tat = 14;
        $test->price = 80000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 009';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS D RNA QUANTITATIVE DETECTION (VIRAL LOAD)';
        $test->minimum_tat = 14;
        $test->price = 35000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 010';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS D RNA DETECTION';
        $test->minimum_tat = 5;
        $test->price = 15000;
        $test->maximum_tat = 7;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 011';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS G DETECTION';
        $test->minimum_tat = 14;
        $test->price = 25000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 012';
        $test->specimen_type_id = SpecimenType::where('key', 'G')->first()->id;
        $test->description = 'HEPATITIS B PANEL: (HBSAg Quantitation, HBSAb, HBeAg,HBeAb, HBcAb IgM, HBcAb)';
        $test->minimum_tat = 2;
        $test->price = 27000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 013';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HEPATITIS C PANEL';
        $test->minimum_tat = 2;
        $test->price = 40000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $testCategory = TestCategory::create(['name' => 'HIV AND ASSOCIATED DISEASES BY PCR METHOD']);
        $test = new TestType;
        $test->test_id = 'GTL 014';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HIV RNA QUANTITATIVE DETECTION(VIRAL LOAD)';
        $test->minimum_tat = 2;
        $test->price = 20000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 015';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HIV RNA DETECTION';
        $test->minimum_tat = 2;
        $test->price = 15000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 016';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HYPERSENSITIVITY REACTION TO ANTIRETROVIRAL DRUG';
        $test->minimum_tat = 14;
        $test->price = 30000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 017';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'PNEUMOCYSTIS JIROVECII (CARINII) DETECTION';
        $test->minimum_tat = 14;
        $test->price = 20000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 018';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'CRYPTOCOCCUS NEOFORMANS DETECTION';
        $test->minimum_tat = 14;
        $test->price = 25000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 019';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HIV DNA DETECTION';
        $test->minimum_tat = 5;
        $test->price = 30000;
        $test->maximum_tat = 9;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 020';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HIV DRUG RESISTANT (HIV GENOTYPE/ DRUG RESISTANCE) ASSAY';
        $test->minimum_tat = 5;
        $test->price = 55000;
        $test->maximum_tat = 9;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL O21';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'CRYPTOCOCCUS NEOFORMANS DETECTION';
        $test->minimum_tat = 14;
        $test->price = 25000;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();


        $testCategory = TestCategory::create(['name' => 'HIV AND ASSOCIATED DISEASES BY PCR METHOD']);
        $test = new TestType;
        $test->test_id = 'GTL 022';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HBV/HDV REAL-TIME PCR TEST FOR SIMULTANEOUS DETECTION OF HBV AND HDV';
        $test->minimum_tat = 2;
        $test->price = 20000;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 023';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HBV/HCV/HIV1/HIV2 REAL-TIME PCR DETECTION';
        $test->minimum_tat = 10;
        $test->price = 50000;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL 024';
        $test->specimen_type_id = SpecimenType::where('key', 'P')->first()->id;
        $test->description = 'HBV/HCV/HIV REAL TIME DETECTION';
        $test->minimum_tat = 10;
        $test->price = 30000;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $testCategory = TestCategory::create(['name' => 'COVID-19 BY PCR METHOD']);
        $test = new TestType;
        $test->test_id = 'GTL CV01';
        $test->specimen_type_id = SpecimenType::where('key', 'SW')->first()->id;
        $test->description = 'COVID – 19 DETECTION (NON TRAVELLERS)';
        $test->minimum_tat = 1;
        $test->price = 25000;
        $test->maximum_tat = 1;
        $test->test_category_id = $testCategory->id;
        $test->save();

        $test = new TestType;
        $test->test_id = 'GTL CV02';
        $test->specimen_type_id = SpecimenType::where('key', 'SW')->first()->id;
        $test->description = 'COVID – 19 DETECTION (TRAVELLERS)';
        $test->minimum_tat = 1;
        $test->price = 30000;
        $test->maximum_tat = 1;
        $test->test_category_id = $testCategory->id;
        $test->save();


    }
}
