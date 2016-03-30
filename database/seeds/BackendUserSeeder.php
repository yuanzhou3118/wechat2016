<?php

use Illuminate\Database\Seeder;

class BackendUserSeeder extends Seeder
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
                    'account' => 'developer2',
                    'pwd' => '111111',
                    'name' => 'sophia',
                    'status' => '1',
                ],
                [
                    'account' => 'developer1',
                    'pwd' => '111111',
                    'name' => 'xinkui',
                    'status' => '1',
                ],
                [
                    'account' => 'developer3',
                    'pwd' => '111111',
                    'name' => 'chengxiao',
                    'status' => '1',
                ],
                [
                    'account' => 'developer4',
                    'pwd' => '111111',
                    'name' => 'phil',
                    'status' => '1',
                ]
            ]
        );
    }
}
