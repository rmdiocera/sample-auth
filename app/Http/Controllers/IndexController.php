<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Validation\ValidationException;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://netzwelt-devtest.azurewebsites.net/']);
    }

    public function __invoke()
    {
        $get_territories_request = $this->client->get('Territories/All', ['http_errors' => false]);

        $get_territories_sc = $get_territories_request->getStatusCode();

        if ($get_territories_sc != 200) {
            throw ValidationException::withMessages([
                'username' => 'Something went wrong with the request.',
            ])->redirectTo(route('login'));
        } else {
            $get_territories_response = json_decode($get_territories_request->getBody()->getContents());

            $territories = $get_territories_response->data;
        }
        
        return inertia('Index', ['territories' => $territories]);
    }
}
