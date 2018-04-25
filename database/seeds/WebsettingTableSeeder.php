<?php

use Illuminate\Database\Seeder;

class WebsettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $line = new \App\Websetting();
        $line->key = 'line_api';
        $line->value = 'KsaH2AyQnOqQHCTbHlsiOioVwjNwhrDdrTZDbvcqxxQ';
        $line->save();

        $email = new \App\Websetting();
        $email->key = 'email_api';
        $email->value = null;
        $email->save();

        $datalimit = new \App\Websetting();
        $datalimit->key = 'data_limit';
        $datalimit->value = 5;
        $datalimit->save();
    }
}
