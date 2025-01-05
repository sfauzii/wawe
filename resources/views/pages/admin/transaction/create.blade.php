@extends('layouts.admin')

@section('title', 'Create Transactions')


@section('content')

    <div class="pagetitle">
        <h1>Transactions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Home</a></li>
                <li class="breadcrumb-item">Create</li>
                {{-- <li class="breadcrumb-item active">Elements</li> --}}
            </ol>
        </nav>
    </div>

    @if ($errors->any())
        <div class="alert-alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    @livewire('transaction-form')

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
