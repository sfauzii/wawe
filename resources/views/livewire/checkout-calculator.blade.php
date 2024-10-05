<div>
    <ul class="nav nav-tabs d-flex justify-content-center custom-nav-tabs" id="paymentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $paymentMethod === 'down_payment' ? 'active' : '' }}" wire:click="$set('paymentMethod', 'down_payment')" href="#downpayment" role="tab">Down Payment</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $paymentMethod === 'full_payment' ? 'active' : '' }}" wire:click="$set('paymentMethod', 'full_payment')" href="#fullpayment" role="tab">Full Payment</a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="paymentTabsContent">
        <div class="tab-pane fade show active" id="paymentInfo" role="tabpanel">
            {{-- <div class="card card-details card-right"> --}}
                <h2>{{ $paymentMethod === 'down_payment' ? 'Down Payment' : 'Full Payment' }} Information</h2>
                <p>
                    @if($paymentMethod === 'down_payment')
                        Anda perlu melunasi pembayaran secara cash pada saat hari keberangkatan
                    @else
                        Anda tidak perlu membayar biaya tambahan apapun pada saat hari keberangkatan
                    @endif
                </p>
                <table class="trip-informations w-100">
                    <tr>
                        <th width="50%">Payment</th>
                        <td width="50%" class="text-right text-blue">{{ $paymentMethod === 'down_payment' ? 'Down Payment 30%' : 'Full Payment' }}</td>
                    </tr>
                    <tr>
                        <th width="50%">Harga Paket</th>
                        <td width="50%" class="text-right text-blue">Rp {{ number_format($transaction->travel_package->price, 0, ',', '.') }}</td>
                    </tr>
                    
                    <tr>
                        <th width="50%">Sub Total x ({{ $transaction->details->count() }})</th>
                        <td width="50%" class="text-right text-blue">Rp {{ number_format($subTotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th width="50%">PPN 11%</th>
                        <td width="50%" class="text-right text-blue">Rp {{ number_format($ppn, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th width="50%">Grand Total</th>
                        <td width="50%" class="text-right text-total">
                            <span class="text-blue">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                </table>
            {{-- </div> --}}
        </div>
    </div>
</div>