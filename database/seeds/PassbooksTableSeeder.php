<?php

use Illuminate\Database\Seeder;

class PassbooksTableSeeder extends Seeder
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
            'send_user_id' => 1,
            'receve_user_id' => 2,
            'send_point' => -1000,
            'receve_point' => 1000,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
        DB::table('passbooks')->insert($param);

        $param = [
            'send_user_id' => 2,
            'receve_user_id' => 3,
            'send_point' => -10000,
            'receve_point' => 10000,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
        DB::table('passbooks')->insert($param);

        $param = [
            'send_user_id' => 3,
            'receve_user_id' => 1,
            'send_point' => -1,
            'receve_point' => 1,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
        DB::table('passbooks')->insert($param);
    }
}
