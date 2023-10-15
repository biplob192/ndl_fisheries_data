<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Interfaces\ThingspeakRepositoryInterface;

class ThingspeakController extends Controller
{
    public function __construct(private ThingspeakRepositoryInterface $thingspeakRepository)
    {
    }

    public function check()
    {
        $response = Http::get('https://thingspeak.com/channels/1857200/feed.json');
        dd($response['feeds']);
    }

    public function index()
    {
        return $this->thingspeakRepository->index();
    }

    public function fisheries_index()
    {
        return $this->thingspeakRepository->fisheries_index();
    }

    public function getData(Request $request)
    {
        return $this->thingspeakRepository->getData($request);
    }
}
