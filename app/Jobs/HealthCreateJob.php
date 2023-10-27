<?php

namespace App\Jobs;

use App\Mail\HealthMailable;
use App\Models\Health;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class HealthCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $health;

    /**
     * Create a new job instance.
     */
    public function __construct(Health $health)
    {
        //
        $this->health = $health;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->health->customer->email)
            ->send(new HealthMailable($this->health));
    }
}
