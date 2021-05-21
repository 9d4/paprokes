<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Person;

class PeopleService
{
    public function isRegistered($rfid, $device_id)
    {
        return !!Person::query()
            ->where('rfid', $rfid)
            ->where('device_id', $device_id)
            ->get()
            ->count();
    }

    public function isRegisteredAny($rfid)
    {
        return !!Person::query()->where('rfid', $rfid)->get()->count();
    }

    /**
     * Get name based on rfid in current device
     * @param string $rfid
     * @param $device_id
     * @return string
     */
    public function getNameByRfid(string $rfid)
    {
        $device_id = request()->route('device');

        return self::getNameByRfidIn($rfid, $device_id);
    }

    public static function getNameByRfidIn($rfid, $device_id)
    {
        if (!$device_id)
            abort(404);

        $device = Device::query()->where('device_id', $device_id)->first();
        $person = Person::query()
            ->where('device_id', $device->id)
            ->where('rfid', $rfid)
            ->first();

        return $person->name ?? '';
    }
}