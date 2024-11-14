<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbProduk extends Migration
{
    public function up()
    {
    $this->forge->addfield([
        'produk_id' => [
            'type' => 'int',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'nama_produk' =>[
            'type' => 'varchar',
            'constraint' => 255,
        ],
        'harga' =>[
            'type' => 'decimal',
            'constraint' => '10,2',
        ],
        'stok' =>[
            'type' => 'int',
            'constraint'=> 11,
        ],
    ]);
    $this->forge->addKey('produk_id', TRUE);
    $this->forge->createTable('tb_produk');
    
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
