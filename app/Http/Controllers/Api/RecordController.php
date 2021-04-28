<?php

namespace App\Http\Controllers\Api;

use App\Events\NewRecord;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecordResource;
use App\Models\Person;
use App\Models\Record;
use App\Traits\HistoryTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {
        $Records = Record::all()->sortByDesc('created_at')->take(100);

        foreach ($Records as $record) {
            $record->registered = !!HistoryTrait::isUserRegistered($record['rfid']);
            $record->name = HistoryTrait::getNameByRFID($record['rfid']);
        }

        return RecordResource::collection($Records);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rfid' => 'required',
        ]);

        $personFound = count(Person::query()->where('rfid', $request->rfid)->get());

        $record = Record::create([
            'rfid' => $request->rfid,
            'temp' => $request->temp,
        ]);

        if ($personFound) {
            $record->registered = true;
        } else {
            $record->registered = false;
        }

        // beta: broadcast
        broadcast(new NewRecord($record))->toOthers();
//        event(new NewRecord($record));

        return new RecordResource($record);
    }

}
