<?php

namespace Database\Seeders\Demy;

use App\Models\SpecimenType;
use App\Models\TestCategory;
use App\Models\TestType;
use Illuminate\Database\Seeder;

class TestCategorySeeder1 extends Seeder
{
    public function run()
    {
        $specimenTypeP = SpecimenType::where('key', 'P')->first();
        $specimenTypeG = SpecimenType::where('key', 'G')->first();

        $testCategory = TestCategory::create(['name' => 'HEPATITIS BY PCR METHOD']);
        $test = new TestType;
        $test->test_id = 'GTL 001';
        $test->name = 'HEPATITIS A DNA DETECTION';
        $test->minimum_tat = 5;
        $test->maximum_tat = 7;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(10000);

        $test = new TestType;
        $test->test_id = 'GTL 002';
        $test->name = 'HEPATITIS B DNA QUANTITATIVE DETECTION (VIRAL LOAD)';
        $test->minimum_tat = 1;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 003';
        $test->name = 'HEPATITIS B DNA DETECTION';
        $test->minimum_tat = 1;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);

        $test = new TestType;
        $test->test_id = 'GTL 004';
        $test->name = 'HEPATITIS B GENOTYPE DNA';
        $test->minimum_tat = 10;
        $test->maximum_tat = 10;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(25000);

        $test = new TestType;
        $test->test_id = 'GTL 005';
        $test->name = 'HEPATITIS C RNA QUANTITATIVE DETECTION (VIRAL LOAD)';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(23000);

        $test = new TestType;
        $test->test_id = 'GTL 006';
        $test->name = 'HEPATITIS C RNA DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(17000);

        $test = new TestType;
        $test->test_id = 'GTL 007';
        $test->name = 'HCV GENOTYPE (DETECTION OF 7 GENOTYPES)';
        $test->minimum_tat = 3;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(30000);

        $test = new TestType;
        $test->test_id = 'GTL 008';
        $test->name = 'HCV RESISTANT TESTING';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(80000);

        $test = new TestType;
        $test->test_id = 'GTL 009';
        $test->name = 'HEPATITIS D RNA QUANTITATIVE DETECTION (VIRAL LOAD)';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(35000);

        $test = new TestType;
        $test->test_id = 'GTL 010';
        $test->name = 'HEPATITIS D RNA DETECTION';
        $test->minimum_tat = 5;
        $test->maximum_tat = 7;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);

        $test = new TestType;
        $test->test_id = 'GTL 011';
        $test->name = 'HEPATITIS G DETECTION';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(25000);

        $test = new TestType;
        $test->test_id = 'GTL 012';
        $test->name = 'HEPATITIS B PANEL: (HBSAg Quantitation, HBSAb, HBeAg,HBeAb, HBcAb IgM, HBcAb)';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeG);
        $test->setPrice(27000);

        $test = new TestType;
        $test->test_id = 'GTL 013';
        $test->name = 'HEPATITIS C PANEL';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(40000);
    }
}
