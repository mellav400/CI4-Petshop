<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id_pelanggan' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_pelanggan' =>[
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'alamat' =>[
                'type' => 'text',
                'constraint' => '200',
            ],
            'telepon' =>[
                'type' => 'int',
                'constraint'=> 11,
            ],
            'created_at'=>[
                'type' => 'datetime',
                'null' => true,
            ],
            'updated_at'=>[
                'type' => 'datetime',
                'null' => true,
            ],
            'deleted_at'=>[
                'type' => 'datetime',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id_pelanggan', TRUE);
        $this->forge->createTable('tb_pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pelanggan');
    }
}
