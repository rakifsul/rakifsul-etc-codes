<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        //
        $faker = \Faker\Factory::create();

        $lastMember = $this->db->table('members')->orderBy('id', 'DESC')->get()->getRowArray();
        $startNumber = $lastMember['id'] ?? 0;

        for ($i = 0; $i < 50; $i++) {
            $newCode = 'M' . str_pad($startNumber + $i, 3, '0', STR_PAD_LEFT);

            $data = [
                'member_code' => $newCode,
                'name' => $faker->name(),
                'address' => $faker->address(),
                'phone' => $faker->phoneNumber(),
                'email' => $faker->email(),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->table('members')->insert($data);
        }
    }
}
