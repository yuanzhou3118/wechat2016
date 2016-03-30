<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('backend_users')->insert(
            [
                [
                    'account' => 'admin',
                    'pwd' => 'Qaz123*()',
                    'name' => 'admin',
                    'status' => '1',
                ],
                [
                    'account' => 'cpd001',
                    'pwd' => 'Password01!',
                    'name' => 'cpd001',
                    'status' => '1',
                ],
                [
                    'account' => 'cpd002',
                    'pwd' => 'asd123*()',
                    'name' => 'cpd002',
                    'status' => '1',
                ]
            ]
        );
    }
}
