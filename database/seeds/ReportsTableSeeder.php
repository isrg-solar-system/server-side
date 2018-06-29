<?php

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  {id:1,title:'Humd',postion:{x:15,y:16},size:{width: 600,height: 600},chart:'area',datefrom:'2018/01/01',dateto:'2018/02/03',group:'day',name:'humd',data:{}},
        //  {id:2,title:'Humd',postion:{x:615,y:16},size:{width: 600,height: 600},chart:'bar',datefrom:'2018/01/01',dateto:'2018/02/03',group:'day',name:'humd',data:{}},
        $a = new \App\Report();
        $a->title = 'ac_output_active_power';
        $a->x = 0;
        $a->y = 0;
        $a->width = 400;
        $a->height = 200;
        $a->chart = 'area';
        $a->datefrom = '2017-11-10';
        $a->dateto = '2017-12-12';
        $a->group = 'allofday';
        $a->name = 'ac_output_active_power';
        $a->user_id = 1;
        $a->save();

        $a = new \App\Report();
        $a->title = 'battery_voltage';
        $a->x = 0;
        $a->y = 200;
        $a->width = 400;
        $a->height = 200;
        $a->chart = 'area';
        $a->datefrom = '2017-11-10';
        $a->dateto = '2017-12-12';
        $a->group = 'allofday';
        $a->name = 'battery_voltage';
        $a->user_id = 1;
        $a->save();
        $a = new \App\Report();
        $a->title = 'grid_frequency';
        $a->x = 0;
        $a->y = 400;
        $a->width = 400;
        $a->height = 200;
        $a->chart = 'area';
        $a->datefrom = '2017-11-10';
        $a->dateto = '2017-12-12';
        $a->group = 'allofday';
        $a->name = 'grid_frequency';
        $a->user_id = 1;
        $a->save();
    }
}
