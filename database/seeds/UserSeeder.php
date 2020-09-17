<?php

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
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'type' => 1,
            'profile' => null,
            'phone' => '09783276825',
            'address' => 'Yangon',
            'dob' => '1996-08-15',
            'create_user_id' => 1,
            'update_user_id' => 1
        ]);
    }
}
