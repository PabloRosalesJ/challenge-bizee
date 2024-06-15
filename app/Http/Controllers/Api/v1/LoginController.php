<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $loginRequest) {
        $client = DB::table('oauth_clients')->where('password_client', 1)->first();

        if (!$client) {
            abort(500, 'the application has not been installed correctly. [Passport]');
        }

        $response = Http::post(env('APP_URL') . '/oauth/token', [
            'grant_type'    => 'password',
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'username'      => $loginRequest->email,
            'password'      => $loginRequest->password,
            'scope'         => '',
        ]);

        $res = $response->json();

        if (! $response->ok()) {
            return $this->error(
                "Invalid credentials!",
                [$res['message']],
                $response->status(),
            );
        }

        return $this->success(data: $res, code:$response->status());
    }
}
