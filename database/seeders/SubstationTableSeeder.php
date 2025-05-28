<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\substation;

class SubstationTableSeeder extends Seeder
{
    public function run()
    {
        $csvData = [
            [
                42403472, '2ATE_5S5', '', '', 'Existing', 'RYB', '33.000 kV', 'Class C', 'TNB', 'DISTRIBUTION',
                '2ATE: 5S5', 'PSPK: 6P5', '630_1C_AL_XLPE', 'NIBONG TEBAL', 1558.640681, 'Insert', '2ATE'
            ],
            [
                40125882, 'AGLN_2L5', '', 'AGLN_2L5', 'Existing', 'RYB', '33.000 kV', 'Class D', 'TNB', 'DISTRIBUTION',
                'AGLN: 2L5', 'AVGO: 4L5', '630_1C_AL_XLPE', 'PULAU PINANG', 331.9963954, 'Update', 'AGLN'
            ],
            [
                41242114, 'AJYA_1L5', '', '', 'Existing', 'RYB', '33.000 kV', 'Class C', 'TNB', 'DISTRIBUTION',
                'AJYA: 1L5', 'SGLL: 2L5 [OFF]', '630_1C_AL_XLPE', 'SUNGAI PETANI', 3004.743039, 'Insert', 'AJYA'
            ],
            [
                42381540, 'AJYA_2L5', '', '', 'Existing', 'RYB', '33.000 kV', 'Class C', 'TNB', 'DISTRIBUTION',
                'AJYA: 2L5', 'SGLL: 1L5 [OFF]', '630_1C_AL_XLPE', 'SUNGAI PETANI', 3002.408442, 'Insert', 'AJYA'
            ],
            [
                42382331, 'AJYA_3L5', '', '', 'Existing', 'RYB', '33.000 kV', 'Class C', 'TNB', 'DISTRIBUTION',
                'AJYA: 3L5', 'AMJA: 1L5 [OFF]', '630_1C_AL_XLPE', 'SUNGAI PETANI', 5577.754579, 'Insert', 'AJYA'
            ],
            [
                42382338, 'AJYA_4L5', '', '', 'Existing', 'RYB', '33.000 kV', 'Class C', 'TNB', 'DISTRIBUTION',
                'AJYA: 4L5', 'AMJA: 2L5', '630_1C_AL_XLPE', 'SUNGAI PETANI', 5573.479585, 'Insert', 'AJYA'
            ],
            [
                41374780, 'AJYA_6L5', '', '', 'Existing', 'RYB', '33.000 kV', 'Class C', 'TNB', 'DISTRIBUTION',
                'AJYA: 6L5', 'MDC: 4S5', '630_1C_AL_XLPE', 'SUNGAI PETANI', 6275.117195, 'Insert', 'AJYA'
            ],
            [
                42381533, 'AJYA_7L5', 'AJYA_7L5', 'Existing', 'RYB', '33.000 kV', 'Class C', 'TNB', 'DISTRIBUTION',
                'AJYA: 7L5', 'KLSA: 1L5', '630_1C_AL_XLPE', 'SUNGAI PETANI', 13186.39531, 'Update', 'AJYA'
            ],
            [
                41242121, 'AJYA_8L5', '', '', 'Existing', 'RYB', '33.000 kV', 'Class C', 'TNB', 'DISTRIBUTION',
                'AJYA: 8L5', 'KLSA: 4L5', '630_1C_AL_XLPE', 'SUNGAI PETANI', 13181.31433, 'Insert', 'AJYA'
            ],
            [
                40223660, 'ALNA_4S5', '', '', 'Existing', 'RYB', '33.000 kV', 'Class D', 'TNB', 'DISTRIBUTION',
                'ALNA: 4S5', 'SPIP: 3L5', '630_1C_AL_XLPE', 'SEBERANG JAYA', 7467.73504, 'Insert', 'ALNA'
            ],
        ];

        foreach ($csvData as $data) {
            SubstationTableSeeder::create([
                'Id' => $data[0],
                'Circ_id' => $data[1],
                'Circ_id2' => $data[2],
                'Circuit_id' => $data[3],
                'Status' => $data[4],
                'Phasing' => $data[5],
                'Voltage' => $data[6],
                'Class' => $data[7],
                'Owner_Type' => $data[8],
                'Owner_Name' => $data[9],
                'From_Info' => $data[10],
                'To_Info' => $data[11],
                'Label' => $data[12],
                'Op_Area' => $data[13],
                'Cal_Length' => $data[14],
                'Status_act' => $data[15],
                'Circ_label' => $data[16],
            ]);
        }
    }
}