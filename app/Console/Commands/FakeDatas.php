<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use InfluxDB\Point;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class FakeDatas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:fakedatas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $points = json_decode('[{"name":"ac_output_active_power"},{"name":"ac_output_frequency"},{"name":"ac_output_voltage"},{"name":"battery_capacity"},{"name":"battery_charging_current"},{"name":"battery_discharge_current"},{"name":"battery_voltage"},{"name":"battery_voltage_offset_for_fans_on"},{"name":"bus_voltage"},{"name":"device_status"},{"name":"eeprom_version"},{"name":"grid_frequency"},{"name":"grid_voltage"},{"name":"inverter_heat_sink_temperature"},{"name":"output_load_percent"},{"name":"pv_charging_power"},{"name":"pv_input_current_for_battery"},{"name":"pv_input_voltage"},{"name":"test"}]');

        foreach ($points as $point){
            $insert = [];
            for($y = 2015 ; $y <= 2018 ; $y ++){ //年
                for ($i=1; $i<=12 ;$i++){  //月
                    $dt = Carbon::create($y, $i, 1, 0, 0, 0, 'Asia/Taipei');
                    for($d = 1 ;$d <= $dt->endOfMonth()->day;$dt++){ //日
                        for($h = 1 ;$h<=24 ;$h ++){
                            $val = $this->fake($point->name);
                            $insert[] =  new Point(
                                $point->name, // name of the measurement
                                floatval ($val), // the measurement value
                                ['region' => 'tw'], // optional tags
                                [], // optional additional fields,
                                Carbon::create($y, $i, $d, $h, 0, 0,'Asia/Taipei')->getTimestamp()
                            );
                        }
                    }
                    $result = InfluxDB::writePoints($points, \InfluxDB\Database::PRECISION_SECONDS);
                    print_r($result);
                }

            }

        }

    }
    protected function fake($data){
        switch ($data){
            case 'ac_output_frequency':
                return rand(580, 620) / 10;
                break;
            case 'ac_output_voltage':
                return rand(2000, 2300) / 10;
                break;
            case 'battery_capacity':
                return rand(55, 100);
                break;
            case 'battery_voltage':
                return rand(200, 290) /10;
                break;
            case 'bus_voltage':
                return rand(370, 390);
                break;
            case 'grid_frequency':
                return rand(580, 620) /10;
                break;
            case 'grid_voltage':
                return rand(198, 122) /10;
                break;
            case 'inverter_heat_sink_temperature':
                return rand(500, 540) ;
                break;
            case 'ac_output_active_power':
                return rand(0, 80) ;
                break;
            case 'battery_charging_current':
                return rand(0, 80)/10 ;
                break;
            case 'battery_discharge_current':
                return rand(0, 20)/10;
                break;
            case 'battery_voltage_offset_for_fans_on':
                return rand(0,1);
                break;
            case 'device_status':
                return (int)10;
                break;
            case 'eeprom_version':
                return (int)4;
                break;
            case 'output_load_percent':
                return rand(0, 600)/10;
                break;
            case 'pv_charging_power':
                return rand(0, 5000)/10;
                break;
            case 'pv_input_current_for_battery':
                return rand(0, 80)/10;
                break;
            case 'pv_input_voltage':
                return rand(0, 800)/10;
                break;
        }
    }
}
