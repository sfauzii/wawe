<?php

namespace App\Http\Controllers\User;

use App\Models\Role;
use App\Models\User;
use App\Models\Testimony;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TestimonyCreated;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Menggunakan Transaction untuk mencari detail transaksi yang sesuai dengan ID transaksi
        $transaction = Transaction::findOrFail($id);

        // Mendapatkan detail transaksi yang pertama ditemukan
        $transactionDetail = $transaction->details->first();

        if (!$transactionDetail) {
            // Tambahkan logika untuk menangani jika tidak ada detail transaksi yang ditemukan
            return redirect()->back()->with('error', 'Detail transaksi tidak ditemukan.');
        }

        // Mendapatkan paket perjalanan yang terkait dengan detail transaksi
        $product = $transactionDetail->travel_package;

        $user = Auth::user();

        return view('pages.users.testimony.create', [
            'transactionDetail' => $transactionDetail,
            'user' => $user,
            // 'items' => $transactions,
            'product' => $product,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required',
            'message' => 'required',
            'transaction_detail_id' => 'required|exists:transaction_details,id',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);



        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            $alertMessage = implode(' ', $messages);

            Alert::error('Validation Error', $alertMessage);
            return redirect()->back()->withInput();
        }

        // Mendapatkan detail transaksi terkait
        $transactionDetail = TransactionDetail::findOrFail($request->transaction_detail_id);
        // Mendapatkan travel_packages_id
        $travelPackageId = $transactionDetail->transaction->travel_packages_id;

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public'); // Menyimpan foto ke dalam storage
                $photos[] = $path; // Menyimpan path foto ke dalam array
            }
        }

        $testimoni = Testimony::create([
            'users_id' => Auth::user()->id,
            'transactions_detail_id' => $request->transaction_detail_id,
            'travel_packages_id' => $travelPackageId,
            'message' => $request->message,
            // 'name' => $request->name,
            'photos' => $photos, // Menyimpan path foto ke dalam kolom 'photos' yang telah di-cast sebagai array    
        ]);

        // Mengirim notifikasi ke admin dan super-admin
        $roles = Role::whereIn('name', ['super-admin', 'admin'])->get();
        $admins = User::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('id', $roles->pluck('id'));
        })->get();

        Notification::send($admins, new TestimonyCreated($testimoni));
        
        Alert::success('Success', 'Horeee!! Kamu berhasil melakukan testimoni');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
