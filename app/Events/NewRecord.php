<?php

namespace App\Events;

use App\Http\Resources\ApiRecordResource;
use App\Http\Resources\RecordResource;
use App\Models\Device;
use App\Models\Record;
use App\Services\PeopleService;
use App\Traits\HistoryTrait;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewRecord implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $record;
    protected $device;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Record $record, Device $device)
    {
        $this->record = new ApiRecordResource($record);
        $this->device = $device;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel(config('channel.record'). '.' . $this->device->device_id);
    }
}
