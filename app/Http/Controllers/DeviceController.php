<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewDevice;
use App\Models\Device;
use App\Models\Key;
use App\Models\User;
use App\Traits\DeviceTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $devices = Auth::user()->devices()->with('key')->get()->sortByDesc('created_at');

        foreach ($devices as $device) {
            $created_at = Carbon::createFromTimeString($device->created_at);
            $device->added_on = $created_at->isoFormat('MMMM DD YYYY \\at HH:mm');
        }

        return view('dash.device.index', ['devices' => $devices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dash.device.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(NewDevice $request)
    {
        $device = new Device;
        $key = new Key;

        $device->user_id = Auth::user()->id;
        $device->device_id = DeviceTrait::generateDeviceId();
        $device->name = $request->name;
        $device->save();

        $key->device_id = $device->id;
        $key->api_key = DeviceTrait::generateDeviceKey();
        $key->save();

        return back()->with(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     */
    public function show(string $id)
    {
        $device = Device::query()
            ->where('device_id', $id)
            ->with(['key', 'user', 'records', 'people'])
            ->first();

        if (!$device)
            abort(404);

        if (Gate::allows('control-device', $device))
            return view('dash.device.single.index', ['device' => $device]);

        abort(403);
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
     */
    public function destroy($device_id)
    {
        Device::query()->where('device_id', $device_id)->delete();
        return back()->with(['deleted' => true]);
    }
}
