<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\TransactionRequest;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Transaction::with([
            'details', 'travel_package', 'user'
        ])->get();

        return view('pages.admin.transaction.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        Transaction::create($data);
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Transaction::with([
            'details', 'travel_package', 'user'
        ])->findOrFail($id);

        return view('pages.admin.transaction.detail', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Transaction::findOrfail($id);

        return view('pages.admin.transaction.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, string $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item = Transaction::findOrFail($id);

        $item->update($data);

        // Session::flash('success', 'Transaction updated successfully.');
        Alert::success('Success', 'Transaction updated successfully.');

        // return redirect()->route('transaction.index');
        
        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();

        // Session::flash('success', 'Transaction deleted successfully.');
        Alert::success('Success', 'Transaction deleted successfully.');

        return redirect()->route('transaction.index');
    }

    public function downloadPdf(string $id) {

        $item = Transaction::with([
            'details', 'travel_package', 'user'
        ])->findOrFail($id);

        $transactionDetails = TransactionDetail::where('transactions_id', $item->id);

        $pdf = Pdf::loadView('pages.admin.transaction.reports.invoice-pdf', [
            'item' => $item,
            'transactionDetails' => $transactionDetails,
        ]);

        return $pdf->download('Invoice ' . ucfirst($item->user->name) . '.pdf');
    }
}
