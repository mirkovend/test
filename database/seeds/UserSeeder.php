<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        User::create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('test')
        ]);

        User::create([
            'name' => 'Test1',
            'email' => 'test1@gmail.com',
            'password' => bcrypt('test')
        ]);

        User::create([
            'name' => 'Test3',
            'email' => 'test3@gmail.com',
            'password' => bcrypt('test')
        ]);
    }
}
