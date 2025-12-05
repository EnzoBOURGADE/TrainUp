<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoriesPrgm extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories_prgm');
    }

    public function down()
    {
        $this->forge->dropTable('categories_prgm');
    }
}
