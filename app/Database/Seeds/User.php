<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Pajar Padillah',
                'nip' => '19753050',
                'username' => 'admin',
                'email' => 'pajarpadillah14@gmail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role_id' => 1,
                'image' => 'default.jpg'
            ],
            [
                'nama' => 'Padillah Pajar',
                'nip' => '19753051',
                'username' => 'user',
                'email' => 'pajarpadillah22@gmail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role_id' => 2,
                'image' => 'default.jpg'
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
