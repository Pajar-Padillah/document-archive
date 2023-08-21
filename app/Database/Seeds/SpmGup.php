<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SpmGup extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1,
                'uraian' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, et!',
                'tanggal' => date('Y-m-d'),
                'file_spm_gup' => 'default.pdf'
            ],
            [
                'user_id' => 1,
                'uraian' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, et!',
                'tanggal' => date('Y-m-d'),
                'file_spm_gup' => 'default.pdf'
            ]
        ];
        $this->db->table('spm_gup')->insertBatch($data);
    }
}
