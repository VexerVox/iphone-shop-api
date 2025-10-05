<?php

namespace App\Services;

use App\Models\DeviceModel;
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
