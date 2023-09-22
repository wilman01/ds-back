<?php

namespace App\Jobs;

use App\Models\Quotation;
use App\Models\User;
use App\Notifications\QuotationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QuotationCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $quotation;
    /**
     * Create a new job instance.
     */
    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $quotation = $this->quotation;
        User::role(['admin'])->each(function(User $user) use($quotation){
            $user->notify(new QuotationNotification($quotation));
        });
    }
}
