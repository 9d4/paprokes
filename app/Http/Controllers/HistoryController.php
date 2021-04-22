<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Record;
use App\Traits\HistoryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HistoryController extends Controller
{
    public function registered()
    {
        $Records = Record::query()->get()->sortByDesc('created_at');
        $parsedRecord = [];

        foreach ($Records as $record) {
            $record->registered = HistoryTrait::isUserRegistered($record->rfid);

            if ($record->registered) {
                array_push($parsedRecord, $record);
                $record->name = HistoryTrait::getNameByRFID($record->rfid);
            }
        }

        return view('dash.history-reg', ['records' => $parsedRecord]);
    }

    public function unregistered()
    {
        $Records = Record::query()->get()->sortByDesc('created_at');
        $parsedRecord = [];

        foreach ($Records as $record) {
            $record->registered = HistoryTrait::isUserRegistered($record->rfid);

            if (!$record->registered) {
                array_push($parsedRecord, $record);
            }
        }

        return view('dash.history-unreg', ['records' => $parsedRecord]);
    }

    public function all(Request $request)
    {
        $now = Carbon::now();
        $out = [];
        $Records = Record::query()->get()->sortByDesc('created_at');

        if ($request->hasAny('name') && trim($request->query('name')) !== '') {
            $out['records'] = [];
            $lookedPeople = Person::query()->where('name', 'like', '%' . $request->name . '%')->get()->sortByDesc('created_at');
            $lookedRFIDs = [];

            foreach ($lookedPeople as $person) {
                array_push($lookedRFIDs, $person->rfid);
            }

            foreach ($Records as $record) {
                if (in_array($record->rfid, $lookedRFIDs))
                    array_push($out['records'], $record);
            }
        } else {
            $out['records'] = $Records;
        }


        foreach ($out['records'] as $record) {
            $record->registered = HistoryTrait::isUserRegistered($record->rfid);

            if ($record->registered)
                $record->name = HistoryTrait::getNameByRFID($record->rfid);

            $time = $record->created_at;
            $hasBeen = Carbon::createFromTimeString($time)->diffInMinutes($now);
            $timeCode = 0;

            if ($hasBeen < 1) {
                $timeCode = 1;
            } elseif ($hasBeen < 3) {
                $timeCode = 2;
            } elseif ($hasBeen <= 5) {
                $timeCode = 3;
            }

            $record->time = $timeCode;
        }

        $out['total'] = count($out['records']);

        return view('dash.history-all', $out);
    }

    public function high()
    {
        $history = Record::query()->where('temp', '>=', 37)->get()->sortByDesc('created_at');

        foreach ($history as $item) {
            if (HistoryTrait::isUserRegistered($item->rfid)) {
                $item->name = HistoryTrait::getNameByRFID($item->rfid);
            }
        }

        return view('dash.temphigh', ['records' => $history, 'total' => count($history)]);
    }

    public function normal()
    {
        $history = Record::query()->where('temp', '<', 37)->get()->sortByDesc('created_at');

        foreach ($history as $item) {
            if (HistoryTrait::isUserRegistered($item->rfid)) {
                $item->name = HistoryTrait::getNameByRFID($item->rfid);
            }
        }

        return view('dash.tempnormal', ['records' => $history, 'total' => count($history)]);
    }
}
