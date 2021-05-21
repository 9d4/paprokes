<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'rfid' => $this->rfid,
            'temp' => $this->temp,
            'name' => $this->name,
            'registered' => !!$this->name,
            'time' => $this->created_at
        ];
    }
}
