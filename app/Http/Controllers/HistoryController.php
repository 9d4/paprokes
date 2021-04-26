<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Record;
use App\Traits\HistoryTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
        $out = [];
        $now = Carbon::now();
        $search = false;

        // Searching?
        if ($request->hasAny('name') && trim($request->query('name')) !== '') {
            $search = true;
            $out['records'] = [];
            $lookedPeople = Person::query()->where('name', 'like', '%' . $request->name . '%')->get()->sortByDesc('created_at');
            $lookedRFIDs = [];

            // get looked people rfid
            foreach ($lookedPeople as $person) {
                array_push($lookedRFIDs, $person->rfid);
            }

            // get records by looked rfid
            foreach (Record::all()->sortByDesc('created_at') as $record) {
                if (in_array($record->rfid, $lookedRFIDs)) {
                    $rec = collect([
                        'rfid' => $record['rfid'],
                        'temp' => $record['temp'],
                        'created_at' => $record['created_at'],
                        'name' => HistoryTrait::getNameByRFID($record['rfid'])
                    ]);

                    array_push($out['records'], $rec);
                }
            }
        } else {
            $Records = Record::query()
                ->sortable(['created_at' => 'desc'])
                ->paginate(50)
                ->withQueryString();

            $out['records'] = $Records;
        }

        foreach ($out['records'] as $record) {
            $record['registered'] = HistoryTrait::isUserRegistered($record['rfid']);

            if ($record['registered'])
                $record['name'] = HistoryTrait::getNameByRFID($record['rfid']);

            $time = $record['created_at'];
            $hasBeen = Carbon::createFromTimeString($time)->diffInMinutes($now);
            $timeCode = 0;

            if ($hasBeen < 1) {
                $timeCode = 1;
            } elseif ($hasBeen < 3) {
                $timeCode = 2;
            } elseif ($hasBeen <= 5) {
                $timeCode = 3;
            }

            if ($search)
                $record->put('time', $timeCode);
            else
                $record->time = $timeCode;
        }

        $out['total'] = count($out['records']);
        $out['total_records'] = Record::count();

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
