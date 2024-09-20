<?php

namespace App\Jobs;

use App\Mail\ThankYou;
use App\Models\Client;
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

    public $clientDetails; // <-- Here Gul withod it undefined $clientDetials


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Client $clientDetails)
    {
        $this->clientDetails = $clientDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // dd($this->clientDetails);


        $ownerReceiver = 'sell@sellyourbags.com';
        //foreach ([$this->clientDetails->email,$ownerReceiver] as $recipient) {

        Mail::to($this->clientDetails->email)->send(new ThankYou($this->clientDetails));
        Mail::to($ownerReceiver)->send(new ThankYou($this->clientDetails));




        //}
    }
}
