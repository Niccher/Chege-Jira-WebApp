<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResetFieldsToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'reset_hash' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'default' => null,
            ],
            'reset_expires_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'reset_hash');
        $this->forge->dropColumn('users', 'reset_expires_at');
    }
}
