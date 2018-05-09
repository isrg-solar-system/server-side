#from influxdb import InfluxDBClient
import datetime,time,json,requests
from random import randint
import calendar

def dval(data):
    if(data == 'ac_output_frequency'):
        return randint(580,620)/10
    if (data == 'ac_output_voltage'):
        return randint(2000, 2300) / 10
    if (data == 'battery_capacity'):
        return randint(55, 100)
    if (data == 'battery_voltage'):
        return randint(200, 290) / 10
    if (data == 'bus_voltage'):
        return randint(370, 390)
    if (data == 'grid_frequency'):
        return randint(580, 620) / 10
    if (data == 'grid_voltage'):
        return randint(108, 122) / 10
    if (data == 'inverter_heat_sink_temperature'):
        return randint(500, 540)
    if (data == 'ac_output_active_power'):
        return randint(0, 80)
    if (data == 'battery_charging_current'):
        return randint(0, 800) / 10
    if (data == 'battery_discharge_current'):
        return randint(0, 200) / 10
    if (data == 'battery_voltage_offset_for_fans_on'):
        return randint(0, 1)
    if (data == 'device_status'):
        return 10
    if (data == 'eeprom_version'):
        return 4
    if (data == 'output_load_percent'):
        return randint(0, 600) / 10
    if (data == 'pv_charging_power'):
        return randint(0, 5000) / 10
    if (data == 'pv_input_current_for_battery'):
        return randint(0, 80) / 10
    if (data == 'pv_input_voltage'):
        return randint(0, 800) / 10

HOST = 'http://127.0.0.1:8000'


points = json.loads('[{"name":"ac_output_active_power"},{"name":"ac_output_frequency"},{"name":"ac_output_voltage"},{"name":"battery_capacity"},{"name":"battery_charging_current"},{"name":"battery_discharge_current"},{"name":"battery_voltage"},{"name":"battery_voltage_offset_for_fans_on"},{"name":"bus_voltage"},{"name":"device_status"},{"name":"eeprom_version"},{"name":"grid_frequency"},{"name":"grid_voltage"},{"name":"inverter_heat_sink_temperature"},{"name":"output_load_percent"},{"name":"pv_charging_power"},{"name":"pv_input_current_for_battery"},{"name":"pv_input_voltage"}]')


while True:
    da = {}
    for point in points:
        key = point['name']
        da[key] = dval(key)
    r = requests.post(HOST + '/api/input/data', data = {'data':json.dumps(da)})
    print(da)
    time.sleep(3)
    
    




