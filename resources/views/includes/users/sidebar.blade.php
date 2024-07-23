<!-- aside section start -->
<aside>
    <div class="top">
        <div class="logo">
            <!-- <h3><span class="danger">Wawe</span></h3> -->
            <a href="index.html"><img src="{{ url('frontend/images/logo.png') }}" alt=""></a>
        </div>
        <div class="close" id="close_btn">
            <span class="material-icons">close</span>
        </div>
        <!-- <div class="close" id="close_btn">
            <span class="material-icons">close</span>
        </div>
        <div class="toggle-btn" id="toggle_btn">
            <span class="material-icons">menu</span>
        </div> -->
    </div>
    <div class="sidebar">
        <a href="dashboard.html" class="active">
            <!-- <span class="material-icons">grid_view</span> -->

            <img src="{{ url('frontend/images/icons/category.png') }}" class="icon-sidebar">
            <h3>Overview</h3>
        </a>
        <a href="ticket.html">
            <!-- <span class="material-icons">receipt_long</span> -->
            <img src="{{ url('frontend/images/icons/ticket-discount.png') }}" class="icon-sidebar">
            <h3>My Ticket</h3>
        </a>
        <a href="transaction.html">
            <!-- <span class="material-icons">payments</span> -->
            <img src="{{ url('frontend/images/icons/empty-wallet.png') }}" class="icon-sidebar">
            <h3>My Transaction</h3>
        </a>

        <a href="settings.html">
            <!-- <span class="material-icons">settings</span> -->
            <img src="{{ url('frontend/images/icons/setting-3.png') }}" class="icon-sidebar">
            <h3>Settings</h3>
        </a>
    </div>
</aside>
<!-- aside section end -->
