<?php

namespace App\Domains\Product\Services;

use App\Domains\Product\Models\DeviceModel;
use Illuminate\Database\Eloquent\Collection;

class DeviceModelService
{
    /**
     * @return Collection<DeviceModel>
     */
    public function all(): Collection
    {
        return DeviceModel::all();
    }
}
