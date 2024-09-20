<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ThankYou extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Client
     */
    public $clientDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $clientDetails)
    {
        $this->client = $clientDetails;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('sell@sellyourbags.com', 'Sell Your Bags'),
            subject: 'Purchase Order from Sell Your Bags',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()

    {
        // dd($this->client);
        return new Content(
            view: 'frontend.emails.thankyou',
            with: [
                'clientName' => $this->client->name,
                'clientEmail' => $this->client->email,
                //currently I am sending the primaray kedy this will be changed later on
                //Gul Muhammad noting here
                'clientPoNumber' => $this->client->po_number,
                'totalAmount' => $this->client->total_amount,
                'clientDetails1' => $this->client,


            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
