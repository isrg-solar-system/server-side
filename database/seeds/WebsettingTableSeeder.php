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
        $email->value = 'key-a0b8a600707180e7995561cd674c33dc';
        $email->save();

        $email = new \App\Websetting();
        $email->key = 'email_api';
        $email->value = 'key-a0b8a600707180e7995561cd674c33dc';
        $email->save();

        $email = new \App\Websetting();
        $email->key = 'email_title';
        $email->value = 'Solar System Alert Bot';
        $email->save();

        $email = new \App\Websetting();
        $email->key = 'email_address';
        $email->value = 'solar@test.liiao.cc';
        $email->save();

        $email = new \App\Websetting();
        $email->key = 'email_format';
        $email->value = '🚨 『@dataname』
目前數值為:@value
狀況:@status';
        $email->save();

        $email = new \App\Websetting();
        $email->key = 'email_format';
        $email->value = 'key-a0b8a600707180e7995561cd674c33dc';
        $email->save();

        $datalimit = new \App\Websetting();
        $datalimit->key = 'data_limit';
        $datalimit->value = 5;
        $datalimit->save();

        $datalimit = new \App\Websetting();
        $datalimit->key = 'line_format' ;
        $datalimit->value = '🚨 『@dataname』
目前數值為:@value
狀況:@status';
        $datalimit->save();

    }
}
