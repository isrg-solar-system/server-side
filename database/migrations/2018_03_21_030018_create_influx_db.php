<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class CreateInfluxDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        InfluxDB::query('CREATE DATABASE '.  env('INFLUXDB_DBNAME', ''));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        InfluxDB::query('DELETE DATABASE '.  env('INFLUXDB_DBNAME', ''));
    }
}
