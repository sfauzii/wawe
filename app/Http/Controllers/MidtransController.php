<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Mail\TransactionFailed;
use App\Mail\TransactionFinish;
use App\Mail\TransactionPending;
use App\Mail\TransactionSuccess;
use App\Models\TransactionDetail;
use App\Models\MidtransNotification;
use Illuminate\Support\Facades\Mail;
use App\Notifications\TransactionSuccessNotification;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {

        // Simpan notifikasi Midtrans
        $midtransNotification = new MidtransNotification();
        $midtransNotification->order_id = $request->order_id;
        $midtransNotification->payload = json_encode($request->all());
        $midtransNotification->save();

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

        // $order = explode('-', $notification->order_id);

        // Assign ke variable
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;
        // $order_id = $order[1];

        // cari transaksi berdasarkan id
        // $transaction = Transaction::findOrFail($order_id);

        $transaction = Transaction::where('order_id', $order_id)->first();

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'CHALLENG';
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        } elseif ($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        } elseif ($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        } elseif ($status == 'deny') {
            $transaction->transaction_status = 'FAILED';
        } elseif ($status == 'expire') {
            $transaction->transaction_status = 'EXPIRED';
        } elseif ($status == 'cancel') {
            $transaction->transaction_status = 'CANCEL';
        }

        // simpan transaksi
        $transaction->save();


        if ($transaction->transaction_status == 'SUCCESS') {
            // Kirim notifikasi ke admin dan super-admin
            // $roles = Role::whereIn('name', ['super-admin', 'admin'])->get();
            // $admins = User::whereHas('roles', function ($query) use ($roles) {
            //     $query->whereIn('id', $roles->pluck('id'));
            // })->get();

            // \Illuminate\Support\Facades\Notification::send($admins, new TransactionSuccessNotification($transaction));

            $usersWithPermission = User::permission('get-notification')->get();

            \Illuminate\Support\Facades\Notification::send(
                $usersWithPermission,
                new TransactionSuccessNotification($transaction)
            );
        }

        // kirimkan email
        // Kirimkan notifikasi email berdasarkan status
        if ($transaction) {
            if ($status == 'pending') {
                Mail::to($transaction->user->email)->send(new TransactionPending($transaction));
                $message = 'Transaction is pending. Please complete the payment.';
            } elseif ($status == 'capture' && $fraud == 'accept') {
                Mail::to($transaction->user->email)->send(new TransactionSuccess($transaction));
                Mail::to($transaction->user->email)->send(new TransactionFinish($transaction));
                $message = 'Transaction is successful.';
            } elseif ($status == 'settlement') {
                Mail::to($transaction->user->email)->send(new TransactionSuccess($transaction));
                Mail::to($transaction->user->email)->send(new TransactionFinish($transaction));
                $message = 'Transaction has been settled successfully.';
            } elseif ($status == 'success') {
                Mail::to($transaction->user->email)->send(new TransactionSuccess($transaction));
                Mail::to($transaction->user->email)->send(new TransactionFinish($transaction));
                $message = 'Transaction was successful.';
            } elseif ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
                Mail::to($transaction->user->email)->send(new TransactionFailed($transaction));
                $message = 'Transaction has failed or been canceled.';
            } elseif ($status == 'capture' && $fraud == 'challenge') {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge',
                    ],
                ]);
            }

            // Kirim response JSON berdasarkan status transaksi
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => $message,
                ],
            ]);
        }

        // Jika tidak ada transaksi, kirim respons error
        return response()->json([
            'meta' => [
                'code' => 404,
                'message' => 'Transaction not found',
            ],
        ]);

        // if ($transaction) {
        //     if ($status == 'pending') {
        //         Mail::to($transaction->user)->send(new TransactionPending($transaction));
        //     } elseif ($status == 'capture' && $fraud == 'accept') {
        //         Mail::to($transaction->user)->send(new TransactionSuccess($transaction));
        //     } elseif ($status == 'settlement' || $status == 'success') {
        //         Mail::to($transaction->user)->send(new TransactionSuccess($transaction));
        //     } elseif ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
        //         Mail::to($transaction->user)->send(new TransactionFailed($transaction));
        //     } elseif ($status == 'capture' && $fraud == 'challenge') {
        //         return response()->json([
        //             'meta' => [
        //                 'code' => 200,
        //                 'message' => 'Midtrans Payment Challenge',
        //             ],
        //         ]);
        //     } else {
        //         return response()->json([
        //             'meta' => [
        //                 'code' => 200,
        //                 'message' => 'Midtrans Payment not settlement',
        //             ],
        //         ]);
        //     }

        //     return response()->json([
        //         'meta' => [
        //             'code' => 200,
        //             'message' => 'Midtrans notification success',
        //         ],
        //     ]);
        // }
    }

    public function finishRedirect(Request $request)
    {
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $transactionStatus = $request->input('transaction_status');

        // Ambil transaksi berdasarkan ID order
        $transaction = Transaction::where('order_id', $orderId)->first();

        // Jika pembayaran berhasil (status "settlement"), arahkan pengguna ke halaman success
        if ($statusCode == 200 && $transactionStatus == 'settlement') {

            $transactionDetails = TransactionDetail::where('transactions_id', $transaction->id);

            return view('pages.success', [
                'items' => $transaction,
                'transactionDetails' => $transactionDetails,
            ]);
        } elseif ($statusCode == 201 && $transactionStatus == 'pending') {
            return view('pages.unfinish');
        } else {
            return view('pages.failed');
        }
    }

    public function unfinishRedirect(Request $request)
    {
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $transactionStatus = $request->input('transaction_status');

        // Jika pembayaran berhasil (status "settlement"), arahkan pengguna ke halaman success
        if ($statusCode == 201 && $transactionStatus == 'pending') {
            return view('pages.unfinish');
        }
    }

    public function errorRedirect(Request $request)
    {
        return view('pages.failed');
    }
}
