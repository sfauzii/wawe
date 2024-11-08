<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\MidtransNotification;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionFinish extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $transaction;
    public $order_id;
    public $midtransData;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->order_id = $transaction->order_id;

        // Fetch and decode Midtrans notifications for the current transaction
        $midtransNotifications = MidtransNotification::where('order_id', $transaction->order_id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Decode the JSON payload and store it as an array
        $this->midtransData = $midtransNotifications->map(function ($notification) {
            return json_decode($notification->payload, true);
        });
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Terima kasih atas pembayaran Anda - WaWe Tour and Travel - ' . $this->order_id)
            ->from('wawe@gmail.com', 'WaWe')
            ->view('email.transaction-finish')
            ->with([
                'transaction' => $this->transaction,
                'midtransData' => $this->midtransData, // Pass decoded data to the view
            ]);
    }
}
