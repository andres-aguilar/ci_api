<?php

class TodoSeed extends Seeder
{
    private $table = 'todo';

    public function run()
    {
        $this->db->truncate($this->table);

        $limit = 5;
        echo "seeding {$limit} TODOs";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";

            $data = array(
                'todo_id' => $this->faker->uuid,
                'todo_title' => $this->faker->words($nb=2, $asText=true) ,
                'todo_comment' => $this->faker->sentence($nbWords=4, $variableNbWords=true),
                'todo_done' => FALSE
            );

            $this->db->insert($this->table, $data);
        }

        echo PHP_EOL;
    }
}
