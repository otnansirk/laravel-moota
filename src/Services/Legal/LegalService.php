<?php
namespace Otnansirk\Moota\Services\Legal;

use Illuminate\Support\Collection;
use Otnansirk\Moota\Facades\MootaCore;

class LegalService
{

    /**
     * Legal
     *
     * @var array
     */
    protected $data;

    /**
     * Merchant id
     *
     * @var string
     */
    protected $id;


    public function __construct(array $data, string $id = null)
    {
        $this->data = $data;
        $this->id   = $id;
    }

    /**
     * Store merchant legal
     *
     * @return Collection
     */
    public function save(): Collection
    {
        $path = "/merchant/legal";
        $res = MootaCore::api($path, 'post', $this->data);

        return collect($res->body());
    }

    /**
     * Update merchant legal
     *
     * @return Collection
     */
    public function update(): Collection
    {
        $path = "/merchant/legal/update/".$this->id;
        $res = MootaCore::api($path, 'post', $this->data);

        return collect($res->body());
    }

}
