@php
    $currentUrl = request()->url();
@endphp

<!-- aside section start -->
<aside>
    <div class="top">
        <div class="logo">
            <!-- <h3><span class="danger">Wawe</span></h3> -->
            <a href="{{ route('home') }}"><img src="{{ url('frontend/svg/images/logo.svg') }}" alt="Logo WaWe"></a>
        </div>
        <div class="close" id="close_btn">
            <span class="material-icons">close</span>
        </div>
    </div>
    <div class="sidebar">
        <a href="{{ route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}"
            class="{{ $currentUrl == route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]) ? 'active' : '' }}">
            <!-- <span class="material-icons">grid_view</span> -->

            <img src="{{ url('frontend/images/icons/category.png') }}" class="icon-sidebar">
            <h3>Overview</h3>
        </a>
        <a href="{{ route('my-ticket', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}"
            class="{{ $currentUrl == route('my-ticket', ['username' => Auth::user()->username, 'id' => Auth::id()]) ? 'active' : '' }}">
            <!-- <span class="material-icons">receipt_long</span> -->
            <img src="{{ url('frontend/images/icons/ticket-discount.png') }}" class="icon-sidebar">
            <h3>My Ticket</h3>
        </a>
        <a href="{{ route('my-transaction', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}"
            class="{{ $currentUrl == route('my-transaction', ['username' => Auth::user()->username, 'id' => Auth::id()]) ? 'active' : '' }}">
            <!-- <span class="material-icons">payments</span> -->
            <img src="{{ url('frontend/images/icons/empty-wallet.png') }}" class="icon-sidebar">
            <h3>My Transaction</h3>
        </a>

        <a href="{{ route('settings', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}"
            class="{{ $currentUrl == route('settings', ['username' => Auth::user()->username, 'id' => Auth::id()]) ? 'active' : '' }}">
            <!-- <span class="material-icons">settings</span> -->
            <img src="{{ url('frontend/images/icons/setting-3.png') }}" class="icon-sidebar">
            <h3>Settings</h3>
        </a>
    </div>
</aside>
<!-- aside section end -->
