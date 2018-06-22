<?php

class TodoSeed extends Seeder
{
    private $table = 'Chinchilla';

    public function run()
    {
        $this->db->truncate($this->table);

        $data = array();

        $this->db->insert($this->table, $data);

        echo PHP_EOL;
    }
}
