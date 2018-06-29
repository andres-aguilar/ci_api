<?php

class Migrate extends CI_Controller
{
    public function test()
    {
        echo "Hola mundo" . PHP_EOL;
    }

    public function list_migrations()
    {
        $this->load->library('migration');

        foreach ($this->migration->find_migrations() as $file) {
            echo "- {$file}" . PHP_EOL;
        }
    }

    public function migrate_all()
    {
        $this->load->library('migration');

        echo "Migration....";
        if (!$this->migration->current()) {
            echo "ERROR: " . PHP_EOL;
            show_error($this->migration->error_string());
        } else {
            echo "DONE" . PHP_EOL;
        }
    }
}
