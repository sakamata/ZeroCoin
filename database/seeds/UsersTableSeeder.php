<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTime = date("Y-m-d H:i:s");

        $param = [
            'user_id' => 'aaaaa',
            'name' => '一ノ瀬aaa',
            'email' => 'aaa@aaa.com',
            'now_point' => 20000,
            'status' => 1,
            'ip' => '192.168.1.1',
            'host' => 'localhost',
            'user_agent' => 'firefox hogehoge',
            'password' => '$2y$10$FyPTeHUateqTs5qjJwR3dOSdJp.bUiLgOLZmGdxeSvGRAjtEFnN/6',
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
        DB::table('users')->insert($param);

        $param = [
            'user_id' => 'bbbbb',
            'name' => '二階堂bbb',
            'email' => 'bbb@bbb.com',
            'now_point' => 10000,
            'status' => 1,
            'ip' => '192.168.1.2',
            'host' => 'localhost',
            'user_agent' => 'chrome hogehoge',
            'password' => '$2y$10$HRjit45IP7E9LM2gsH91fuv1hGyGRhcZggRzz37j.WKth52D8x/Gi',
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
        DB::table('users')->insert($param);

        $param = [
            'user_id' => 'ccccc',
            'name' => '三鷹ccc',
            'email' => 'ccc@ccc.com',
            'now_point' => 2000000000,
            'status' => 1,
            'ip' => '192.168.1.3',
            'host' => 'localhost',
            'user_agent' => 'edge hogehoge',
            'password' => '$2y$10$lZN7ttH7xReRGaJ5B5X/xOxZ4AHA4mF.73ke4Bm8rD3xP1pYJ./1O',
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
        DB::table('users')->insert($param);
    }
}
