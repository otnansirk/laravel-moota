<?php

namespace Otnansirk\Moota\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Otnansirk\Moota\Facades\MootaCore;
use Illuminate\Support\Facades\Validator;
use Otnansirk\Moota\Validation\UserRegisterRequest;
use Otnansirk\Moota\Exception\MootaCore400Exception;

class MootaAuthService
{

    /**
     * Generate access token
     *
     * @param string $email
     * @param string $pass
     * @param array $scopes
     * @return Collection
     */
    public function login(string $email, string $pass, array $scopes = ["api"]): Collection
    {
        $path = "/auth/login";
        $data = [
            "email"    => $email,
            "password" => $pass,
            "scopes"   => $scopes,
        ];

        $res = MootaCore::api($path, 'post', $data);

        return collect($res->body());

    }

    /**
     * Destroy access token
     *
     * @return Collection
     */
    public function logout(): Collection
    {
        $path = "/auth/logout";

        $res = MootaCore::api($path, 'post');

        return collect($res->body());
    }

    /**
     * Register user
     *
     * @return Collection
     */
    public function register(array $data): Collection
    {
        $validate = Validator::make($data, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception();
        }


        $path = "/auth/register";
        $res  = MootaCore::api($path, 'post', $data);

        return collect($res->body());
    }

    /**
     * Get user profile
     *
     * @return Collection
     */
    public function profile(): Collection
    {
        $path = "/user";
        $res  = MootaCore::api($path, 'get');

        return collect($res->body());
    }
}
