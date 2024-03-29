<?php

use Illuminate\Database\Seeder;

class TokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default api token
        \App\Token::updateOrCreate([
            'type' => 'api token',
            'value' => 'd3e76da78c846375c7722438a9f69b06',
            ],
            [
            'api_id' => '1',
            'expire_at' => '2020-10-30 16:02:04',
        ]);
    }
}
