<?php
namespace Otnansirk\Moota\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Otnansirk\Moota\Facades\MootaCore;
use Otnansirk\Moota\Rules\MutationType;
use Illuminate\Support\Facades\Validator;
use Otnansirk\Moota\Exception\MootaCore400Exception;

class MootaMutationService
{

    /**
     * This endpoint is for getting the latest updates before the bank interval runs.
     *
     * @param string $bankId
     * @return Collection
     */
    public function refresh(string $bankId): Collection
    {
        $path = "/bank/".$bankId."/refresh";
        $res  = MootaCore::api($path, 'post');
        return collect($res->body());
    }

    /**
     * Get list of mutations
     *
     * @param array $params
     * @return Collection
     */
    public function list(array $params): Collection
    {

        $params['bank'] = collect($params)->get('bank_id', '');
        $validate = Validator::make($params, [
            "type"       => ['string', new MutationType],
            "bank"       => ['string'],
            "start_date" => ['string', 'date_format:Y-m-d'],
            "end_date"   => ['string', 'date_format:Y-m-d'],
            "tag"        => ['string'],
            "page"       => ['number'],
            "par_page"   => ['number']
        ]);

        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception($validate);
        }

        $path = "/mutation";
        $res  = MootaCore::api($path, 'get', $params);
        return collect($res->body());
    }

    /**
     * Create dummy mutation
     *
     * @param array $data
     * @param string $bankId
     * @return Collection
     */
    public function store(array $data, string $bankId): Collection
    {
        $validate = Validator::make($data, [
            "date"       => ['string', 'date_format:Y-m-d'],
            "note"       => ['string'],
            "amount"     => ['number'],
            "type"       => ['string', new MutationType],
        ]);

        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception($validate);
        }

        $path = "/mutation/store/".$bankId;
        $res  = MootaCore::api($path, 'post', $validate->validated());
        return collect($res->body());
    }

    /**
     * Update note of mutation
     *
     * @param string $note
     * @param string $mutation_id
     * @return Collection
     */
    public function note(string $note, string $mutationId): Collection
    {
        $path = "/mutation/".$mutationId."/note";
        $res  = MootaCore::api($path, 'post', ["note" => $note]);
        return collect($res->body());
    }

    /**
     * Delete mutation can be multiple
     *
     * @param mixed $mutationIds
     * @return Collection
     */
    public function destroy(mixed $mutationIds): Collection
    {
        $mutationIds = !is_array($mutationIds)? [$mutationIds]: $mutationIds;
        $path = "/mutation/destroy";
        $res  = MootaCore::api($path, 'post', ["mutations" => $mutationIds]);
        return collect($res->body());
    }

    /**
     * Delete mutation can be multiple
     *
     * @param mixed $mutationIds
     * @return Collection
     */
    public function tags(mixed $tags, string $mutationId): Collection
    {
        $tags = !is_array($tags)? [$tags]: $tags;
        $path = "/tagging/mutation/".$mutationId;
        $res  = MootaCore::api($path, 'post', ["name" => $tags]);
        return collect($res->body());
    }

    /**
     * Get summary of mutation
     *
     * @param array $params
     * @return Collection
     */
    public function summary(array $params): Collection
    {

        $validate = Validator::make($params, [
            "bank_id"    => ['string'],
            "type"       => ['string', new MutationType],
            "start_date" => ['string', 'date_format:Y-m-d'],
            "end_date"   => ['string', 'date_format:Y-m-d'],
        ]);

        if ($validate->fails()) {
            Log::warning($validate->errors());
            throw new MootaCore400Exception($validate);
        }

        $path = "/mutation/summary";
        $res  = MootaCore::api($path, 'get', $validate->validated());
        return collect($res->body());
    }

    /**
     * This for testing push data webhook
     *
     * @param string $mutationId
     * @return Collection
     */
    public function webhook(string $mutationId): Collection
    {
        $path = "/mutation/".$mutationId."/webhook";
        $res  = MootaCore::api($path, 'post');
        return collect($res->body());
    }
}
