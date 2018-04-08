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
        $a->title = 'Humd';
        $a->x = 15;
        $a->y = 16;
        $a->width = 600;
        $a->height = 600;
        $a->chart = 'area';
        $a->datefrom = '2018/01/01';
        $a->dateto = '2018/02/03';
        $a->group = 'day';
        $a->name = 'humd';
        $a->user_id = 1;
        $a->save();

        $a = new \App\Report();
        $a->title = 'Temp';
        $a->x = 715;
        $a->y = 16;
        $a->width = 600;
        $a->height = 600;
        $a->chart = 'line';
        $a->datefrom = '2018/01/01';
        $a->dateto = '2018/02/03';
        $a->group = 'month';
        $a->name = 'temp';
        $a->user_id = 1;
        $a->save();
    }
}
