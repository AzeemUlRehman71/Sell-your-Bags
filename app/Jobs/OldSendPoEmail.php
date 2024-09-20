<?php

namespace App\Jobs;

use App\Mail\ThankYou;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPoEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $clientDetails; // <-- Here Gul withod it undefined $clientDetials


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($clientDetails)
    {
        $this->clientDetails =$clientDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      
       // dd($this->clientDetails);

          foreach ([$this->clientDetails->email,'gulmuhammad57@sellyourbags.com'] as $recipient) {

            Mail::to($recipient)->send(new ThankYou($this->clientDetails));

         


        }
    }
}
