<?php

namespace App\Observers;

use App\Jobs\QuotationCreateJob;
use App\Models\Quotation;

class QuotationObserver
{
    public function created(Quotation $quotation): void
    {
        dispatch(new QuotationCreateJob($quotation));
    }
}
