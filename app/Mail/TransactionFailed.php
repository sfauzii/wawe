<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransactionFailed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $transaction;
    public $order_id;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->order_id = $transaction->order_id; // Set order_id dari transaction

    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Proses pembayaran Anda telah kadaluarsa - WaWe Tour and Travel - ' . $this->order_id)
            ->from('wawe@gmail.com', 'WaWe')
            ->view('email.transaction-failed')
            ->with([
                'transaction' => $this->transaction,
            ]);
    }
}
