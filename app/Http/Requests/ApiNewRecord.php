<?php

namespace App\Http\Requests;

use App\Models\Key;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiNewRecord extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $api_key = $this->get('api_key');
        $key = Key::query()->where('api_key', $api_key)->with('device')->get();

        if ($key->count()) {
            // bind device model
            $this->merge([
                'device' => $key->first()->device()->first(),
            ]);

            return true;
        }
        return false;
    }

    public function rules()
    {
        return [
            'rfid' => 'required',
        ];
    }
}
