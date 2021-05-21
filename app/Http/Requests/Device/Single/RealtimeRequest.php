<?php

namespace App\Http\Requests\Device\Single;

use App\Models\Device;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class RealtimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $device_id = $this->route('device');
        $device = Device::query()->where('device_id', $device_id)->first();

        if (!$device)
            abort(404);

        if (!Gate::allows('control-device', $device)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
