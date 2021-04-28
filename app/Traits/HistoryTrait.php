<?php

namespace App\Traits;

use App\Models\Person;
use Carbon\Carbon;

trait HistoryTrait
{
    public static function isUserRegistered(string $rfid)
    {
        $personFound = count(Person::query()->where('rfid', $rfid)->get());
        return $personFound ?? true;
    }

    public static function getPersonByRFID(string $rfid)
    {
        $person = Person::query()->where('rfid', $rfid)->first();
        return $person;
    }

    public static function getNameByRFID(string $rfid)
    {
        if (self::getPersonByRFID($rfid) != null)
            return self::getPersonByRFID($rfid)->name;
        else
            return null;
    }

    public static function isTimestampToday(string $timestamp)
    {
        $time = Carbon::createFromTimeString($timestamp);
        return $time->isToday();
    }

    public static function isTempTooHigh(float $temp) {

    }

}