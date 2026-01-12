<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamesToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'username',
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'first_name',
            ],
            'bio' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'last_name',
            ],
            'avatar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'bio',
            ],
            'newsletter' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'after'      => 'avatar',
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['first_name', 'last_name', 'bio', 'avatar', 'newsletter']);
    }
}
