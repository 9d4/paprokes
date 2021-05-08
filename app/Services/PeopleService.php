<?php

namespace App\Services;

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
}