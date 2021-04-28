<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Record;
use App\Traits\HistoryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RealTimeHistoryController extends Controller
{
    public function fetchHistory()
    {
        $out = [];
        $now = Carbon::now();

        $Records = Record::all();
        $out['records'] = $Records;

        foreach ($out['records'] as $record) {
            $record['registered'] = HistoryTrait::isUserRegistered($record['rfid']);

            if ($record['registered'])
                $record['name'] = HistoryTrait::getNameByRFID($record['rfid']);
        }

        $out['total'] = count($out['records']);
        $out['total_records'] = Record::count();

        return $out;
    }
}
