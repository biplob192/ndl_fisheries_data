<?php

namespace App\Console\Commands;

use DateTime;
use DateTimeZone;
use App\Models\Attendance;
use App\Models\SensorData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class StoreDailySensorData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:sensor-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command will store daily sensor data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://thingspeak.com/channels/1857200/feed.json');

        // Set the timezone to Dhaka, Bangladesh
        $timezone = new DateTimeZone('Asia/Dhaka');

        foreach ($response['feeds'] as $data) {
            $datetime = new DateTime($data['created_at']);
            $datetime->setTimezone($timezone); // Set the timezone to Dhaka, Bangladesh
            $datetimeFormatted = $datetime->format('Y-m-d H:i:s');

            SensorData::updateOrCreate(
                [
                    'entry_id'      => $data['entry_id'],
                ],
                [
                    'voltage'       => $data['field1'],
                    'current'       => $data['field2'],
                    'power'         => $data['field3'],
                    'datetime'      => $datetimeFormatted
                ]
            );
        }

        $this->info('Sensor data stored successfully!');
    }
}
