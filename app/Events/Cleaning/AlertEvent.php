<?php

namespace Selvah\Events\Cleaning;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Selvah\Models\Material;

class AlertEvent
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Material $material)
    {
    }
}
