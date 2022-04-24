<?php

namespace Database\Seeders;

use App\Models\TestType;
use App\Models\SpecimenType;
use App\Models\TestCategory;
use Illuminate\Database\Seeder;

class TestCategorySeeder7 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specimenTypeSP = SpecimenType::where('key', 'SP')->first();
        $specimenTypeBSW = SpecimenType::where('key', 'SW')->first();
        $specimenTypeHT = SpecimenType::where('key', 'H & T')->first();
        $specimenTypeT = SpecimenType::where('key', 'T')->first();
        $specimenTypeU = SpecimenType::where('key', 'U')->first();

        $testCategory = TestCategory::create(['name' => 'PATERNITY TESTING WITH 24 LOCI ANALYSIS']);

        $this->getTest($testCategory,'GTL 074',[$specimenTypeBSW],'DNA PATERNITY TEST X1 (DNA PROFILE)',14,14,70000);
        $this->getTest($testCategory,'GTL 075',[$specimenTypeBSW],'DNA PATERNITY TEST X2',30,30,100000);
        $this->getTest($testCategory,'GTL 076',[$specimenTypeBSW],'DNA PATERNITY TEST X3',14,14, 165000);
        $this->getTest($testCategory,'GTL 077',[$specimenTypeBSW],'DNA PATERNITY TEST X4',14,14, 220000);
        $this->getTest($testCategory,'GTL 078',[$specimenTypeBSW],'DNA PATERNITY TEST X5',14,14, 275000);
        $this->getTest($testCategory,'GTL 079',[$specimenTypeT],'DNA ANALYSIS ON BONY TISSUES FROM CADAVER',14,14, 200000);
        $this->getTest($testCategory,'GTL 079B',[$specimenTypeSP, $specimenTypeHT],'DNA ANALYSIS ON CADAVER',0,0, 0.0, true);

        $testCategory = TestCategory::create(['name' => 'KINSHIP TESTING (FOR MALE LINEAGE)']);

        $this->getTest($testCategory,'GTL 080',[$specimenTypeBSW],'KINSHIP TESTING X1',14,14, 120000);
        $this->getTest($testCategory,'GTL 081',[$specimenTypeBSW],'KINSHIP TESTING X2',14,14, 180000);
        $this->getTest($testCategory,'GTL 082',[$specimenTypeBSW],'KINSHIP TESTING X3',14,14, 260000);

        $testCategory = TestCategory::create(['name' => 'PRENATAL DIAGNOSIS']);

        $this->getTest($testCategory,'GTL 083',[$specimenTypeSP],'NON-INVASIVE PRENATAL TESTING (CHROMOSOMAL ABNORMALITIES, SEX DETERMINATION, GENOTYPING)',14,14, 140000);
        $this->getTest($testCategory,'GTL 084',[$specimenTypeSP],'INVASIVE PRENATAL TESTING (CHORIONIC SAMPLING)',14,14, 150000);

        $testCategory = TestCategory::create(['name' => 'TUBERCULOSIS BY PCR']);

        $this->getTest($testCategory,'GTL 085',[$specimenTypeU],'TB PCR',3,5, 15000);
        $this->getTest($testCategory,'GTL 086',[$specimenTypeU],'TB (GENE XPERT)',10,10, 30000);
    }

    private function getTest($testCategory, string $testId, array $specimenTypes, string $description, int $minTAT, int $maxTAT, float $price, bool $callIn = false): TestType
    {
        $test = new TestType;
        $test->test_id = $testId;
        $test->description = $description;
        $test->minimum_tat = $minTAT;
        $test->maximum_tat = $maxTAT;
        $test->should_call_in_for_details = $callIn;
        $test->price = $price;
        $test->test_category_id = $testCategory->id;
        $test->save();

        foreach ($specimenTypes as $specimenType){
            $test->specimenTypes()->save($specimenType);
        }

        return $test;
    }
}
