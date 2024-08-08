@extends('layouts.admin')

@section('content')

    @if ($errors->any())
        <div class="alert-alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Transaction</h5>
                
                        <!-- General Form Elements -->
                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
                
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Travel Package</label>
                                <div class="col-sm-10">
                                    <select name="travel_package_id" id="travel_package" class="form-select" onchange="updateTotal()">
                                        <option disabled selected>Pilih Package</option>
                                        @foreach ($travelPackages as $package)
                                            <option value="{{ $package->id }}" data-price="{{ $package->price }}">
                                                {{ $package->title }} (Quota: {{ $package->kuota }}) - Rp {{ number_format($package->price, 0, ',') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Username <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">@</span>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" oninput="updateTotal()" required>
                                    </div>
                                </div>
                            </div>
                
                            <input type="hidden" name="transaction_status" value="PENDING">
                
                            <h5 class="card-title">You can add other users in one transaction</h5>
                
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Users</label>
                                <div class="col-sm-10">
                                    <div id="users">
                                        <div class="input-group mb-3 user">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                            <input type="text" name="users[0][username]" placeholder="Username" class="form-control" oninput="updateTotal()">
                                        </div>
                                    </div>
                                    <button type="button" id="add-user" class="btn btn-primary">Add User</button>
                                </div>
                            </div>
                
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Total Transaction <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="total-amount" style="font-weight: bold;" class="form-control mb-3" disabled>
                                </div>
                            </div>
                
                            <button type="submit" class="btn btn-success btn-block w-100" style="background-color: #012970;">Create Transaction</button>
                        </form>
                        <!-- End General Form Elements -->
                    </div>
                </div>
                
                <script>
                    function updateTotal() {
                        // Get the selected travel package price
                        var travelPackageSelect = document.getElementById('travel_package');
                        var selectedPackage = travelPackageSelect.options[travelPackageSelect.selectedIndex];
                        var packagePrice = parseFloat(selectedPackage.getAttribute('data-price')) || 0;
                
                        // Get the number of users
                        var userCount = document.getElementById('users').getElementsByClassName('user').length;
                
                        // Calculate the total amount
                        var totalAmount = packagePrice * userCount;
                
                        // Update the total amount display
                        document.getElementById('total-amount').value = totalAmount.toFixed();
                    }
                
                    document.getElementById('add-user').addEventListener('click', function() {
                        var usersDiv = document.getElementById('users');
                        var userCount = usersDiv.getElementsByClassName('user').length;
                        var newUserDiv = document.createElement('div');
                        newUserDiv.classList.add('input-group', 'mb-3', 'user');
                        newUserDiv.innerHTML = `
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" name="users[${userCount}][username]" placeholder="Username" class="form-control" oninput="updateTotal()">
                        `;
                        usersDiv.appendChild(newUserDiv);
                        updateTotal();
                    });
                
                    document.addEventListener('DOMContentLoaded', function() {
                        updateTotal();
                    });
                </script>
                

            </div>


        </div>
    </section>

    {{-- <div class="container">
        <h1>Create Transaction</h1>
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="travel_package">Travel Package</label>
                <select name="travel_package_id" id="travel_package" class="form-control" onchange="updateTotal()">
                    <option disabled>Pilih Package</option>
                    @foreach ($travelPackages as $package)
                        <option value="{{ $package->id }}" data-price="{{ $package->price }}">{{ $package->title }}
                            (Quota:
                            {{ $package->kuota }})
                            - Rp {{ number_format($package->price, 0, ',') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username"
                    oninput="updateTotal()" required>
            </div>
            <input type="hidden" name="transaction_status" value="PENDING">

            <div class="form-group">
                <label for="users">Users</label>
                <div id="users">
                    <div class="user">
                        <input type="text" name="users[0][username]" placeholder="Username" class="form-control"
                            oninput="updateTotal()">
                    </div>
                </div>
                <button type="button" id="add-user" class="btn btn-primary">Add User</button>
            </div>
            <div class="form-group">
                <label>Total Transaction Amount: </label>
                <p id="total-amount"></p>
            </div>
            <button type="submit" class="btn btn-success">Create Transaction</button>
        </form>
    </div>

    <script>
        function updateTotal() {
            // Get the selected travel package price
            var travelPackageSelect = document.getElementById('travel_package');
            var selectedPackage = travelPackageSelect.options[travelPackageSelect.selectedIndex];
            var packagePrice = parseFloat(selectedPackage.getAttribute('data-price')) || 0;

            // Get the number of users
            var userCount = document.getElementById('users').getElementsByClassName('user')
                .length; // +1 for the main user input

            // Calculate the total amount
            var totalAmount = packagePrice * userCount;

            // Update the total amount display
            document.getElementById('total-amount').innerText = totalAmount.toFixed();
        }

        document.getElementById('add-user').addEventListener('click', function() {
            var usersDiv = document.getElementById('users');
            var userCount = usersDiv.getElementsByClassName('user').length;
            var newUserDiv = document.createElement('div');
            newUserDiv.classList.add('user');
            newUserDiv.innerHTML = `
            <input type="text" name="users[${userCount}][username]" placeholder="Username" class="form-control" oninput="updateTotal()">
        `;
            usersDiv.appendChild(newUserDiv);
            updateTotal();
        });

        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
        });
    </script> --}}

@endsection
