<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        //
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $data = [
                'title'       => $faker->sentence(3),
                'author'      => $faker->name(),
                'category'    => $faker->company(),
                'year'        => $faker->year(),
                'fine_unit'   => 1000,
                'cover'       => null, // bisa diganti link fake
                'created_at'  => date('Y-m-d H:i:s'),
            ];

            $this->db->table('books')->insert($data);
        }
    }
}
