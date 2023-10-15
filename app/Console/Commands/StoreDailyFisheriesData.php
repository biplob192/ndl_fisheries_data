<?php

namespace App\Console\Commands;

use DateTime;
use DateTimeZone;
use App\Models\FisheriesData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class StoreDailyFisheriesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:fisheries-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command will store daily fisheries data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api.thingspeak.com/channels/2303991/feeds.json');

        // Set the timezone to Dhaka, Bangladesh
        $timezone = new DateTimeZone('Asia/Dhaka');

        foreach ($response['feeds'] as $data) {
            $datetime = new DateTime($data['created_at']);
            $datetime->setTimezone($timezone); // Set the timezone to Dhaka, Bangladesh
            $datetimeFormatted = $datetime->format('Y-m-d H:i:s');

            FisheriesData::updateOrCreate(
                [
                    'entry_id'                  => $data['entry_id'],
                ],
                [
                    'dissolved_oxygen'          => $data['field1'],
                    'ph'                        => $data['field2'],
                    'turbidity'                 => $data['field3'],
                    'water_temperature'         => $data['field4'],
                    'electrical_conductivity'   => $data['field5'],
                    'datetime'                  => $datetimeFormatted
                ]
            );
        }

        $this->info('Fisheries data stored successfully!');
    }
}
