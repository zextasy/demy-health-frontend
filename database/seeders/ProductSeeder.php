<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{

    protected $products = [
        [
            'name' => 'Biosafety Cabinet (Class 2 A2)',
            'model' => 'Biobase/BSC-1100IIA2-X',
            'country' => null,
            'price' => 4740400,
            'extra_information' => [
                'Category Name' => 'Hospital and Laboratory Products',
            ],
        ],
        [
            'name' => 'Linegene K Plus Real time PCR',
            'model' => 'Bioer/LinegeneK Plus',
            'country' => null,
            'price' => 9783100,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'Linegene 9600 Real time PCR',
            'model' => 'Bioer/Linegene 9600,',
            'country' => 'Germany',
            'price' => 12580000,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'Quantgene 9600 Real time PCR',
            'model' => 'Bioer/Quantgene 9600',
            'country' => 'Germany',
            'price' => 13788700,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'PCR Cabinet / Lamina flow',
            'model' => 'Searchtech AH172',
            'country' => null,
            'price' => 1384400,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'PCR Cabinet / Lamina flow',
            'model' => 'Biobase/BBS-V680',
            'country' => null,
            'price' => 1319400,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'Autoclave (50L)',
            'model' => null,
            'country' => null,
            'price' => 898100
        ],
        [
            'name' => 'Gene Pure Pro Nucleic Acid Purification System (1ml reaction volume x 32samples)',
            'model' => 'Bioer NPA-32P',
            'country' => 'Germany',
            'price' => 8979100
        ],
        [
            'name' => 'Bench-top Micro Centrifuge (maxspeed: 16,000 rpm; capacity: 1.5ml x12)',
            'model' => 'Biobase/BKC-MH16',
            'country' => null,
            'price' => 599600
        ],
        [
            'name' => 'Mini Centrifuge (max speed: 10,000 rpm; capacity; 12x1.5ml/0.2ml)',
            'model' => 'Biobase/Mini-10K+',
            'country' => null,
            'price' => 334600
        ],
        [
            'name' => 'Vortex Mixer',
            'model' => null,
            'country' => null,
            'price' => 111000
        ],
        [
            'name' => 'Heating Block (Main Body)',
            'model' => 'Bioer HB-202',
            'country' => 'Germany',
            'price' => 379400
        ],
        [
            'name' => 'Heating/ Cooling Block (Main Body) and accessories',
            'model' => 'Bioer CHB-202',
            'country' => 'Germany',
            'price' => 543300
        ],
        [
            'name' => 'Heating/ Cooling accessories',
            'model' => 'BlockA- 40x1.5ml',
            'country' => 'Germany',
            'price' => 119200
        ],
        [
            'name' => 'Unknown',
            'model' => 'BlockC- 96x0.2ml',
            'country' => 'Germany',
            'price' => 120300
        ],
        [
            'name' => 'Thermoshaker and Accessories',
            'model' => 'Bioer MB-202',
            'country' => 'Germany',
            'price' => 1558800
        ],
        [
            'name' => 'Pipettes (0.5-10ul)',
            'model' => 'Huawei H10',
            'country' => null,
            'price' => 26900
        ],
        [
            'name' => 'Pipettes (10-100ul)',
            'model' => 'Huawei H100',
            'country' => null,
            'price' => 26900
        ],
        [
            'name' => 'Pipettes (100-1000ul)',
            'model' => 'Huawei H1000',
            'country' => null,
            'price' => 26900
        ],
        [
            'name' => 'Pipette Stand',
            'model' => null,
            'country' => null,
            'price' => 22300
        ],
        [
            'name' => 'Eppendorf Tube Rack',
            'model' => null,
            'country' => null,
            'price' => 12800
        ],
        [
            'name' => 'PCR Tube Rack',
            'model' => null,
            'country' => null,
            'price' => 18700,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'Pipette Tips Rack (0.5-10ul)',
            'model' => null,
            'country' => null,
            'price' => 9800
        ],
        [
            'name' => 'Pipette Tips Rack (200ul)',
            'model' => null,
            'country' => null,
            'price' => 9800
        ],
        [
            'name' => 'Pipette Tips Rack (1000ul)',
            'model' => null,
            'country' => null,
            'price' => 9800
        ],
        [
            'name' => '96 Deep Well Plate (2.2ml)-24 pieces',
            'model' => null,
            'country' => null,
            'price' => 111500
        ],
        [
            'name' => '8 Strip Tips (16 pieces)',
            'model' => null,
            'country' => null,
            'price' => 14400
        ],
        [
            'name' => '96 Strip Tips (for NPA 96)',
            'model' => 'Bioer',
            'country' => null,
            'price' => 30400
        ],
        [
            'name' => 'Eppendorf Tube',
            'model' => 'Axygen',
            'country' => null,
            'price' => 14600,
        ],
        [
            'name' => '96 Tube',
            'model' => null,
            'country' => null,
            'price' => 33200,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'PCR Tube (0.2ml)',
            'model' => null,
            'country' => null,
            'price' => 25800,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'PCR Tube (0.1ml)',
            'model' => null,
            'country' => null,
            'price' => 77600,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => '0.2ml 96-well PCR plate (half-skirted) (10pcs/lot)',
            'model' => 'Bioer',
            'country' => null,
            'price' => 19800,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'Optical sealing Film (compatible for qPCR)',
            'model' => 'Bioer',
            'country' => null,
            'price' => 19800,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => '0.2ml PCR 8-Stip tubes',
            'model' => 'Bioer',
            'country' => null,
            'price' => 33200,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => '0.2ml PCR 8-Stip Caps',
            'model' => 'Bioer',
            'country' => null,
            'price' => 13600,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => '2-Well Magnetic Rack (6pcs/lot)',
            'model' => 'Bioer',
            'country' => null,
            'price' => 22400
        ],
        [
            'name' => '0.2ml PCR Tube Rack-96 well',
            'model' => null,
            'country' => null,
            'price' => 6400,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => '10ul Pipette Tips',
            'model' => null,
            'country' => null,
            'price' => 6700
        ],
        [
            'name' => 'SARS-CoV-2 Nucliec acid detection kit',
            'model' => 'Bioer',
            'country' => 'Germany',
            'price' => 120000
        ],
        [
            'name' => 'ANDiS FAST SARS-CoV-2 RT-qPCR Detection Kit (3D Med)',
            'model' => null,
            'country' => null,
            'price' => 250000
        ],
        [
            'name' => 'Rapid SARS-CoV-2 detection kit',
            'model' => 'Bioer',
            'country' => 'Germany',
            'price' => 72000
        ],
        [
            'name' => 'Biospin Virus DNA/RNA Extraction Kit (100T)',
            'model' => 'Bioer',
            'country' => 'Germany',
            'price' => 80000
        ],
        [
            'name' => 'MagaBioPlusVirusDNA/RNA Extraction Kit II (100T)',
            'model' => 'Bioer',
            'country' => 'Germany',
            'price' => 221700
        ],
        [
            'name' => 'MagaBio plus VirusDNA/RNA Purification Kit III (Pre-packed, ready to use, dispense sampleonly) (32T)',
            'model' => 'Bioer',
            'country' => 'Germany',
            'price' => 50000
        ],
        [
            'name' => 'Viral Transport Medium plus swab (vswab4ml/tube/test)',
            'model' => 'Bioer',
            'country' => 'Germany',
            'price' => 1000
        ],
        [
            'name' => 'HIV-1 PCR Fluorescence Quantitative Kit',
            'model' => 'Bioer',
            'country' => 'Germany',
            'price' => 342100,
            'extra_information' => [
                'Category Name' => 'PCR and Reagents',
            ],
        ],
        [
            'name' => 'ELIGENE HBV RT KIT',
            'model' => 'Eligene',
            'country' => null,
            'price' => 335200,
        ],
        [
            'name' => 'ELIGENE HCV RT KIT',
            'model' => 'Eligene',
            'country' => null,
            'price' => 335200
        ],
        [
            'name' => 'Absolute Alcohol',
            'model' => 'Honeywell',
            'country' => null,
            'price' => 18300
        ],
        [
            'name' => 'Rnase (100 ml x 2)',
            'model' => 'Bioer',
            'country' => 'Germany',
            'price' => 12400
        ],
        [
            'name' => 'Non-Frost Refrigerator (-20C)',
            'model' => null,
            'country' => null,
            'price' => 715600
        ],
        [
            'name' => 'Non-Frost Refrigerator (-80°C) for Biobanking/Long term Sample Storage',
            'model' => null,
            'country' => null,
            'price' => null,
        ],
        [
            'name' => 'Laptop',
            'model' => null,
            'country' => null,
            'price' => 300600
        ],
        [
            'name' => 'Lab coat hangers',
            'model' => null,
            'country' => null,
            'price' => 6700
        ],
        [
            'name' => 'Refrigerator (2-8°C)',
            'model' => null,
            'country' => null,
            'price' => 420100
        ],
        [
            'name' => 'Structural Design for exiting building',
            'model' => null,
            'country' => null,
            'price' => 180000
        ],
        [
            'name' => 'Linegene 9600',
            'model' => '(Bioer)',
            'country' => 'Germany',
            'price' => 12580000,
            'extra_information' => [
                'NO OF CHANNELS' => 6,
                'NO OF WELLS' => 96,
                'PRECALIBRATED DYES' => 'FAM, SYBR Green I, HEX/VIC, TET/JOE/CY3/NED/TAMRA, ROX, TEXAS-RED, Cy5, Cy5.5,  reserved path',
                'Delivery Timeline' => '5-6 weeks after payment confirmation',
                'Category Name' => 'PCR and Reagents'
            ],
        ],
        [
            'name' => 'Quantgene 9600',
            'model' => '(Bioer)',
            'country' => 'Germany',
            'price' => 13788700,
            'extra_information' => [
                'NO OF CHANNELS' => 6,
                'NO OF WELLS' => 96,
                'PRECALIBRATED DYES' => 'FAM、SYBR Green I, VIC、 HEX. TET、 JOE、 TAMRA、CY3、NED, ROX. Texas-Red, Cy5, Cy5.5, For Customized',
                'Delivery Timeline' => '2-3 weeks after payment confirmation',
                'Category Name' => 'PCR and Reagents'
            ],
        ],
    ];

    //'PCR and Reagents', 'Hospital and Laboratory Products', 'Pharmaceuticals', 'Procurement and Supply'
    public function run()
    {
        foreach ($this->products as $product){
            $productModel = Product::updateOrCreate(['name' => $product['name']], $product);
            $mediaUrl = public_path("demyhealth/images/products/default-product-image.png");
            $ProductUrl = public_path("demyhealth/images/products/{$product['name']}.jpg");
            if (file_exists($ProductUrl)){
                $mediaUrl = $ProductUrl;
            }
            $productModel->copyMedia($mediaUrl)->toMediaCollection('pictures');
            if (array_key_exists('extra_information', $product)){
                $extraInformation = $product['extra_information'];

                if (array_key_exists('Category Name', $extraInformation)){
                    $productCategory = ProductCategory::query()->where('name', $extraInformation['Category Name'])->first();

                    if (isset($productCategory)){
                        $productCategory->products()->save($productModel);
                    }
                }
            }
        }
    }
}
