<?php

namespace App\Traits;

use App\Models\Device;
use App\Models\Key;
use Illuminate\Support\Str;
use Ramsey\Uuid\Guid\Guid;

trait DeviceTrait
{
    public static function generateDeviceId(): string
    {
        // generate random id and get the first sequence before '-'
        $id = Str::before(Guid::uuid4(), '-');

        if (Device::query()->where('device_id', $id)->get()->count())
            return self::generateDeviceId();

        return $id;
    }

    public static function generateDeviceKey(): string
    {
        $key = Str::random(32);

        if (Key::query()->where('api_key', $key)->get()->count())
            return self::generateDeviceKey();

        return $key;
    }
}