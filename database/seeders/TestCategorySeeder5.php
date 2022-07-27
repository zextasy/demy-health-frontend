<?php

namespace Database\Seeders;

use App\Models\SpecimenType;
use App\Models\TestCategory;
use App\Models\TestType;
use Illuminate\Database\Seeder;

class TestCategorySeeder5 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specimenTypeP = SpecimenType::where('key', 'P')->first();
        $specimenTypeTSC = SpecimenType::where('key', 'TSC')->first();

        $testCategory = TestCategory::create(['name' => 'THROMBOPHILIA SCREENING']);

        $test = new TestType;
        $test->test_id = 'GTL 050';
        $test->name = 'FACTOR 5 LEIDEN, FACTOR 2, PROTEIN C, FREE PROTEIN S, ANTITHROMBIN 111 ACTIVITY';
        $test->minimum_tat = 5;
        $test->maximum_tat = 9;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(85000);

        $test = new TestType;
        $test->test_id = 'GTL 051';
        $test->name = 'FACTOR 5 LEIDEN';
        $test->minimum_tat = 5;
        $test->maximum_tat = 7;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 052';
        $test->name = 'FACTOR 2 LEIDEN';
        $test->minimum_tat = 0;
        $test->maximum_tat = 0;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 053';
        $test->name = 'PROTEIN C';
        $test->minimum_tat = 2;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeTSC);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 054';
        $test->name = 'FREE PROTEIN S';
        $test->minimum_tat = 2;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeTSC);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 055';
        $test->name = 'ANTITHROMBIN 111 ACTIVITY';
        $test->minimum_tat = 2;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeTSC);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 056';
        $test->name = 'ANTI-BETA-2 GLYCOPROTEIN 1 ANTIBODY';
        $test->minimum_tat = 3;
        $test->maximum_tat = 5;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeTSC);
        $test->setPrice(20000);

        $testCategory = TestCategory::create(['name' => 'DRUG RESISTANCE BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 057';
        $test->name = 'KPC/OXA 48 AND OXA 162 TYPING IN ENTEROBACTERIACEAE AND NFGMB';
        $test->minimum_tat = 1;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 058';
        $test->name = 'CTX-M TYPING IN ENTEROBACTERIACEAE';
        $test->minimum_tat = 1;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 059';
        $test->name = 'VIM, IMP AND NDM TYPING IN ENTEROBACTERIACEAE AND NFGMB';
        $test->minimum_tat = 1;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(20000);

        $test = new TestType;
        $test->test_id = 'GTL 060';
        $test->name = 'MRSA PCR DETECTION';
        $test->minimum_tat = 1;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);
    }
}
