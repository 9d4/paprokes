<?php

namespace App\Http\Controllers;

use App\Http\Requests\Device\Single\IndexRequest;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RecordController extends Controller
{
    public function index(IndexRequest $request, string $device_id)
    {
        $service = resolve('DeviceService');

        $data['device'] = $request->device;
        $data['records'] = $service->records($data['device']);

        return view('dash.device.single.records', $data);
    }
}
