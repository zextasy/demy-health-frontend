<?php

namespace Database\Seeders;

use App\Models\SpecimenType;
use App\Models\TestCategory;
use App\Models\TestType;
use Illuminate\Database\Seeder;

class TestCategorySeeder6 extends Seeder
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
        $specimenTypeUrine = SpecimenType::where('key', 'URINE')->first();

        $testCategory = TestCategory::create(['name' => 'SEXUALLY TRANSMITED INFECTIONS (STI) BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 061';
        $test->name = 'NEISSERIA GONORRHEA DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
        $test->setPrice(15000);
        $test->specimenTypes()->save($specimenTypeUrine);

        $test = new TestType;
        $test->test_id = 'GTL 062';
        $test->name = 'TRICHOMONAS VAGINALIS DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
        $test->setPrice(10000);

        $test = new TestType;
        $test->test_id = 'GTL 063';
        $test->name = 'CHLAMYDIA TRACHOMATIS DNA DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
        $test->setPrice(19000);
        $test->specimenTypes()->save($specimenTypeUrine);

        $test = new TestType;
        $test->test_id = 'GTL 064';
        $test->name = 'HERPES SIMPLEX VIRUS 1& 2 DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(14000);

        $test = new TestType;
        $test->test_id = 'GTL 065';
        $test->name = 'HERPES SIMPLEX VIRUS 1 & 2 QUANTITATION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(18000);

        $testCategory = TestCategory::create(['name' => 'SEXUALLY TRANSMITTED INFECTIONS (STI) BY PCR METHOD (MULTIPLEX ASSAYS)']);

        $test = new TestType;
        $test->test_id = 'GTL 066';
        $test->name = 'N.GONOR./С.TRACHOMATIS/T.VAGINALIS/M.GENITALIUM';
        $test->minimum_tat = 1;
        $test->maximum_tat = 2;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeSW);
        $test->setPrice(20000);
        $test->specimenTypes()->save($specimenTypeUrine);

        $testCategory = TestCategory::create(['name' => 'INFECTIONS BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 067';
        $test->name = 'MYCOBACTERIUM DNA DETECTION';
        $test->minimum_tat = 5;
        $test->maximum_tat = 7;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);

        $test = new TestType;
        $test->test_id = 'GTL 068';
        $test->name = 'SALMONELLA DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);

        $test = new TestType;
        $test->test_id = 'GTL 069';
        $test->name = 'CMV DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);

        $test = new TestType;
        $test->test_id = 'GTL 070';
        $test->name = 'CYTOMEGALOVIRUS QUANTIFICATION PCR';
        $test->minimum_tat = 4;
        $test->maximum_tat = 5;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(30000);

        $test = new TestType;
        $test->test_id = 'GTL 071';
        $test->name = 'EPSTEIN-BARR VIRUS (EBV) DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);

        $test = new TestType;
        $test->test_id = 'GTL 072';
        $test->name = 'RUBELLA DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);

        $test = new TestType;
        $test->test_id = 'GTL 073';
        $test->name = 'TOXOPLASMA DETECTION';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(15000);
    }
}
