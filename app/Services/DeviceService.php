<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Person;

class DeviceService
{
    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function myDevices()
    {
        return Device::query()->where('user_id', $this->user->id)->get();
    }

    public function myDevicesFirstTen()
    {
        return $this->user
            ->devices()
            ->get()
            ->sortByDesc('created_at')
            ->take(10);
    }

    public function records(Device $device)
    {
        return $device->records()
            ->sortable(['created_at' => 'desc'])
            ->paginate(50)
            ->withQueryString();
    }

    public static function getDeviceName($device_id)
    {
        return Device::query()->where('device_id', $device_id)->first()->name ?? null;
    }
}
