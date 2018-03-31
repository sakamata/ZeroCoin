<?php

use Illuminate\Database\Seeder;

class GovernorsSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1レコードのみの設定値記録 table
        $param = [
            'basic_income' => 20000,
            'max_tax_free' => 100000,
            'bi_tax_zero_point' => 1000000,
        ];
        DB::table('governors_settings')->insert($param);
    }
}
