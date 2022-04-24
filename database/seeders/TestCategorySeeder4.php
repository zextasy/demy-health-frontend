<?php

namespace Database\Seeders;

use App\Models\TestType;
use App\Models\SpecimenType;
use App\Models\TestCategory;
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
        $test->description = 'BRCA PANEL. REAL TIME PCR DETECTION AND ALLELIC DISCRIMINATION OF 8 MUTATIONS OF BRCA 1&2 GENES';
        $test->minimum_tat = 2;
        $test->maximum_tat = 3;
        $test->price = 60000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypePWB);
        $test->specimenTypes()->save($specimenTypeBSW);

        $test = new TestType;
        $test->test_id = 'GTL 039';
        $test->description = 'EGFR';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->price = 50000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 040';
        $test->description = 'BRAF V600E MUTATION';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->price = 40000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 041';
        $test->description = 'K-RAS MUTATION';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->price = 40000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 042';
        $test->description = 'NRAS';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->price = 40000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 043';
        $test->description = 'FCGR';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->price = 30000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 044';
        $test->description = 'PGX-5FU';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->price = 25000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 045';
        $test->description = 'PGX-TMPT';
        $test->minimum_tat = 15;
        $test->maximum_tat = 15;
        $test->price = 27000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $testCategory = TestCategory::create(['name' => 'GENETIC PREDISPOSITION TEST BY PCR METHOD']);

        $test = new TestType;
        $test->test_id = 'GTL 046';
        $test->description = 'CARDIOVASCULAR DISEASE RISK ASSESMENT (DETECTION OF 8 GENETIC VARIANTS)';
        $test->minimum_tat = 7;
        $test->maximum_tat = 7;
        $test->price = 40000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 047';
        $test->description = 'G-6PD GENE MUTATION DETECTION BY PCR';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->price = 25000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);

        $test = new TestType;
        $test->test_id = 'GTL 048';
        $test->description = 'HLA B27 QUALITATIVE PCR';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->price = 40000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
        $test->specimenTypes()->save($specimenTypeG);

        $test = new TestType;
        $test->test_id = 'GTL 049';
        $test->description = 'Y CHROMOSOME MICRODELETION [BLOOD]';
        $test->minimum_tat = 14;
        $test->maximum_tat = 14;
        $test->price = 100000;
        $test->test_category_id = $testCategory->id;
        $test->save();
        $test->specimenTypes()->save($specimenTypeP);
    }
}
