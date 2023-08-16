<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://netzwelt-devtest.azurewebsites.net/']);
    }

    public function viewLoginPage(Request $request)
    {
        // $request->session()->flush();
        return inertia('Login');
    }

    public function login(Request $request) 
    {
        // return $request->all();
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $api_login_request = $this->client->post('Account/SignIn', [
            'json' => [
                'username' => $request->username,
                'password' => $request->password,
            ],
            'http_errors' => false
        ]);

        $api_login_sc = $api_login_request->getStatusCode();

        if ($api_login_sc != 200) {
            throw ValidationException::withMessages([
                'username' => 'The username or password entered is invalid.',
            ])->redirectTo(route('login'));
        } else {
            // $api_login_response = json_decode($api_login_request->getBody()->getContents());

            $request->session()->put('is_authenticated', true);

            return redirect()->route('index');
        }
    }
}
