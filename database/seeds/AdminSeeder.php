<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 123,
            'create'=> 'yes',
            'edit'=> 'yes',
            'delete'=> 'yes',
            'open'=> 'yes',
            'reopen'=> 'yes',
            'close'=> 'yes',
            'added_by' => 'none',
            'closed' => 'no'
        ]);
    }
}
