<?php

namespace Database\Seeders\Demy;

use App\Models\SpecimenType;
use App\Models\TestCategory;
use App\Models\TestType;
use Illuminate\Database\Seeder;

class TestCategorySeeder4 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specimenTypeP = SpecimenType::where('key', 'P')->first();
        $specimenTypeBSW = SpecimenType::where('key', 'BSW')->first();
        $specimenTypeG = SpecimenType::where('key', 'G')->first();
        $specimenTypePWB = SpecimenType::where('key', 'P(WB)')->first();

        $testCategory = TestCategory::create(['name' => 'ONCOLOGY BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 038';
        $test->name = 'BRCA PANEL. REAL TIME PCR DETECTION AND ALLELIC DISCRIMINATION OF 8 MUTATIONS OF BRCA 1&2 GENES';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypePWB);
        $test->setPrice(60000);
        $test->specimenTypes()->save($specimenTypeBSW);

        $test = new TestType;
        $test->test_id = 'GTL 039';
        $test->name = 'EGFR';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(50000);

        $test = new TestType;
        $test->test_id = 'GTL 040';
        $test->name = 'BRAF V600E MUTATION';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(40000);

        $test = new TestType;
        $test->test_id = 'GTL 041';
        $test->name = 'K-RAS MUTATION';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(40000);

        $test = new TestType;
        $test->test_id = 'GTL 042';
        $test->name = 'NRAS';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(40000);

        $test = new TestType;
        $test->test_id = 'GTL 043';
        $test->name = 'FCGR';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(30000);

        $test = new TestType;
        $test->test_id = 'GTL 044';
        $test->name = 'PGX-5FU';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(25000);

        $test = new TestType;
        $test->test_id = 'GTL 045';
        $test->name = 'PGX-TMPT';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(27000);

        $testCategory = TestCategory::create(['name' => 'GENETIC PREDISPOSITION TEST BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 046';
        $test->name = 'CARDIOVASCULAR DISEASE RISK ASSESMENT (DETECTION OF 8 GENETIC VARIANTS)';
        $test->minimum_tat = 7;
        $test->maximum_tat = 7;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(40000);

        $test = new TestType;
        $test->test_id = 'GTL 047';
        $test->name = 'G-6PD GENE MUTATION DETECTION BY PCR';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(25000);

        $test = new TestType;
        $test->test_id = 'GTL 048';
        $test->name = 'HLA B27 QUALITATIVE PCR';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(40000);
        $test->specimenTypes()->save($specimenTypeG);

        $test = new TestType;
        $test->test_id = 'GTL 049';
        $test->name = 'Y CHROMOSOME MICRODELETION [BLOOD]';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->setPrice(100000);
    }
}
