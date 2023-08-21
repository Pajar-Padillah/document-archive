<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lumpsum extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'no_spm' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'uraian' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tanggal' => [
                'type' => 'DATE'
            ],
            'box' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'file_lumpsum' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('lumpsum');
    }

    public function down()
    {
        $this->forge->dropTable('lumpsum');
    }
}
