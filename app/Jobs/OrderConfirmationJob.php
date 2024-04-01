<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\Admin\PlaceOrder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\User\OrderConfirmationMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class OrderConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $detail;
    public function __construct($detail)
    {
    $this->detail = $detail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('abubakarchaudhary731@gmail.com')->send(new PlaceOrder($this->detail));
        Mail::to(auth()->user()->email)->send(new OrderConfirmationMessage($this->detail));
    }
}
