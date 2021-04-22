<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecordResource;
use App\Models\Person;
use App\Models\Record;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $records = Record::all();

        foreach ($records as $record) {
            if ($personFound = count(Person::query()->where('rfid', $record->rfid)->get())) {
                $record->registered = true;
            } else {
                $record->registered = false;
            }
        }

        return RecordResource::collection($records);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RecordResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'rfid' => 'required',
//            'temp' => 'required|numeric'
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

        return new RecordResource($record);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
