<?php
namespace Otnansirk\Moota\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Otnansirk\Moota\Facades\MootaCore;
use Otnansirk\Moota\Helpers\CreateBank;
use Illuminate\Support\Facades\Validator;
use Otnansirk\Moota\Rules\AvailableBankType;
use Otnansirk\Moota\Exception\MootaCore400Exception;

class MootaBankService
{

    /**
     * Get list available of bank
     *
     * @param integer $page
     * @param integer $limit
     * @return Collection
     */
    public function available(int $page = 1, int $limit = 10): Collection
    {
        $path = '/bank/available';
        $res  = MootaCore::api($path, 'get', [
            'page' => $page,
            'per_page' => $limit,
        ]);

        return collect($res->body());
    }

    /**
     * Get list of your bank accounts that you have registered at moota.
     *
     * @param integer $page
     * @param integer $limit
     * @return Collection
     */
    public function list(int $page = 1, int $limit = 10): Collection
    {
        $path = '/bank';
        $res  = MootaCore::api($path, 'get', [
            'page' => $page,
            'per_page' => $limit,
        ]);

        return collect($res->body());
    }

    /**
     * Stor bank account
     *
     * @param array $data
     * @return Collection
     */
    public function store(array $payload): Collection
    {

        $validate = Validator::make($payload, [
            "bank_type"     => ['required', new AvailableBankType],
            "username"      => ['required','string'],
            "password"      => ['required','string'],
            "name_holder"   => ['required', 'string'],
            "account_number"=> ['required']
        ]);
        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception($validate);
        }

        $path = '/bank/store';
        $data = new CreateBank($payload);
        $res  = MootaCore::api($path, 'post', $data->payload());
        return collect($res->body());
    }

    /**
     * Update bank account
     *
     * @param array $payload
     * @param string $id
     * @return Collection
     */
    public function update(array $payload, string $id): Collection
    {

        $validate = Validator::make($payload, [
            "bank_type"     => ['required', new AvailableBankType],
            "username"      => ['required','string'],
            "password"      => ['required','string'],
            "name_holder"   => ['required', 'string'],
            "account_number"=> ['required']
        ]);

        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception($validate);
        }

        $path = '/bank/update/'.$id;
        $data = new CreateBank($payload);
        $res  = MootaCore::api($path, 'post', $data->payload());
        return collect($res->body());
    }

    /**
     * Destroy bank account
     *
     * @param string $id
     * @return Collection
     */
    public function destroy(string $id): Collection
    {
        $path = '/bank/'.$id.'/destroy';
        $res  = MootaCore::api($path, 'post');
        return collect($res->body());
    }

    /**
     * Request OTP
     *
     * This is for activating your Gojek and Ovo E-wallet accounts,
     * after you make a call request this endpoint, there will be an OTP that you will receive via your mobile number,
     * and make a call MootaBank::verifyOtp() after getting OTP Code :
     *
     * @param string $id
     * @return Collection
     */
    public function requestOtp(string $id): Collection
    {
        $path = '/bank/request/otp/'.$id;
        $res  = MootaCore::api($path, 'post');
        return collect($res->body());
    }

    /**
     * Verification OTP
     *
     * This is for activating your Gojek and Ovo E-wallet accounts.
     * after you get the OTP code, verify the code through this endpoint
     *
     * @param int $otpCode
     * @param string $id
     * @return Collection
     */
    public function verifyOtp(int $otpCode, string $id): Collection
    {
        $path = '/bank/verification/otp/'.$id;
        $res  = MootaCore::api($path, 'post', ['otp_code' => $otpCode]);
        return collect($res->body());
    }
}
