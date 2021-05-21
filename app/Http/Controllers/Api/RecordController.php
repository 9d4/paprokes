<?php

namespace App\Http\Controllers\Api;

use App\Events\NewRecord;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiNewRecord;
use App\Http\Requests\Device\Single\IndexRequest;
use App\Http\Resources\ApiRecordResource;
use App\Http\Resources\RecordResource;
use App\Models\Person;
use App\Models\Record;
use App\Services\DeviceService;
use App\Services\PeopleService;
use App\Traits\HistoryTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(IndexRequest $request, $device_id)
    {
        $Records = Record::query()->where('device_id', $request->device->id)->with('device')->get()->sortByDesc('created_at');

        foreach ($Records as $record) {
            $peopleService = resolve('PeopleService');
            $record->name = $peopleService->getNameByRfidIn($record->rfid, $record->device()->first()->device_id);
        }

        return ApiRecordResource::collection($Records);
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

    public function newRecord(ApiNewRecord $request)
    {
        $device = $request->device;

        // push record
        $record = new Record;

        $record->device_id = $request->device->id;
        $record->rfid = $request->rfid;
        $record->temp = $request->temp;

        $record->save();

        // push name if exists
        $peopleService = resolve('PeopleService');
        $record->name = $peopleService->getNameByRfidIn($record->rfid, $device->device_id);

        // fire event
        broadcast(new NewRecord($record, $device));

        return new ApiRecordResource($record);
    }
}
