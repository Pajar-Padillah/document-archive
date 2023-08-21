<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Lumpsum extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1,
                'uraian' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, et!',
                'tanggal' => date('Y-m-d'),
                'file_lumpsum' => 'default.pdf'
            ],
            [
                'user_id' => 1,
                'uraian' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, et!',
                'tanggal' => date('Y-m-d'),
                'file_lumpsum' => 'default.pdf'
            ]
        ];
        $this->db->table('lumpsum')->insertBatch($data);
    }
}
