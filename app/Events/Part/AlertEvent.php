<?php

namespace Selvah\Events\Part;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Selvah\Models\PartExit;

class AlertEvent
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public PartExit $partExit)
    {
    }
}
