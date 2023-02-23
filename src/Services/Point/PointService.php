<?php
namespace Otnansirk\Moota\Services\Point;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Otnansirk\Moota\Facades\MootaCore;
use Illuminate\Support\Facades\Validator;
use Otnansirk\Moota\Exception\MootaCore400Exception;

class PointService
{

    /**
     * List of available point
     *
     * @return Collection
     */
    public function get(): Collection
    {
        $path = "/topup/denom";
        $res = MootaCore::api($path, 'get');

        return collect($res->body());
    }


    /**
     * This is to view the history of the point has been used
     *
     * @return Collection
     */
    public function used(array $filters = []): Collection
    {

        $validate = Validator::make($filters, [
            "start_date" => ['string', 'date_format:Y-m-d'],
            'end_date'   => ['string', 'date_format:Y-m-d'],
            'page'       => ['numeric'],
            'per_page'   => ['numeric'],
        ]);

        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception($validate);
        }

        $path = "/transaction";
        $res = MootaCore::api($path, 'get', $validate->validated());

        return collect($res->body());
    }
}
