<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserSettings extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'timezone' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'Africa/Nairobi',
                'null'       => true,
                'after'      => 'bio',
            ],
            'date_format' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'YYYY-MM-DD',
                'null'       => true,
                'after'      => 'timezone',
            ],
            'preferences' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'date_format',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['timezone', 'date_format', 'preferences']);
    }
}
