<?php
namespace Otnansirk\Moota\Services;

use Illuminate\Support\Collection;
use Otnansirk\Moota\Facades\MootaCore;

class MootaTagService
{

    /**
     * Create tabngging
     *
     * @param string $name
     * @return Collection
     */
    public function store(string $name): Collection
    {
        $path = "/tagging";
        $res  = MootaCore::api($path, 'post', ['name' => $name]);
        return collect($res->body());
    }

    /**
     * Update tagging
     *
     * @param string $name
     * @param string $id
     * @return Collection
     */
    public function update(string $name, string $id): Collection
    {
        $path = "/tagging/".$id;
        $res  = MootaCore::api($path, 'put', ['name' => $name]);
        return collect($res->body());
    }
}
