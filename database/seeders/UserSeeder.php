<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('12345'),
                'level' => 'admin',
            ]
        ];
        foreach($data as $row){
            User::create($row);
        }
    }
}
