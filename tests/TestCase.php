<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\PersonalAccessTokenResult;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $headers = [];
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::first();

        /** @var PersonalAccessTokenResult */
        $token = $this->user->createToken('Personal access token - test');
        $accessToken = $token->toArray()['accessToken'];

        $this->headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ];
    }
}
