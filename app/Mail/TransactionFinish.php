<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransactionFinish extends Mailable
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
        $this->order_id = $transaction->order_id;
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
            ]);
    }

}
