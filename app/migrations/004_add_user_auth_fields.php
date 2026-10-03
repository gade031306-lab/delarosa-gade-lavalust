<?php

class Add_user_auth_fields {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if (!$this->_lava->dbforge->table_exists('users')) {
            throw new RuntimeException('The users table must exist before adding API authentication fields.');
        }

        if (!$this->_lava->dbforge->column_exists('users', 'role')) {
            $this->_lava->dbforge->add_column('users', [
                'role' => [
                    'type'       => 'ENUM',
                    'constraint' => "'admin','moderator','user'",
                    'null'       => FALSE,
                    'default'    => 'user',
                ],
            ]);
        }

        if (!$this->_lava->dbforge->column_exists('users', 'is_active')) {
            $this->_lava->dbforge->add_column('users', [
                'is_active' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                    'default'    => 1,
                ],
            ]);
        }
    }

    public function down()
    {
        // Keep these auth fields when rolling back; they may already have been
        // present before this compatibility migration was applied.
    }
}
