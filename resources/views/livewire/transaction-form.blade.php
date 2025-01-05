<section class="section">
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">

                    <!-- General Form Elements -->
                    <div class="my-4 p-4 pb-0">
                        <form wire:submit.prevent="createTransaction">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Travel Package <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select wire:model.live="selectedPackageId" id="travel_package" class="form-select">
                                        <option value="">Select Package</option>
                                        @foreach ($travelPackages as $package)
                                            <option value="{{ $package->id }}" data-price="{{ $package->price }}">
                                                {{ ucwords($package->title) }} - Rp
                                                {{ number_format($package->price, 0, ',') }}
                                                (Departure:
                                                {{ \Carbon\Carbon::parse($package->departure_date)->format('d F Y') }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="paymentMethod" class="col-sm-2 col-form-label">Payment Method<span
                                        class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <select wire:model.live="paymentMethod" id="paymentMethod" class="form-select">
                                        <option value="full_payment">Full Payment</option>
                                        <option value="down_payment">Down Payment (25%)</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="newUsername" class="col-sm-2 col-form-label">Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">@</span>
                                        <input type="text" wire:model.defer="newUsername" id="newUsername"
                                            class="form-control @error('newUsername') is-invalid @enderror"
                                            placeholder="Enter Name">
                                    </div>
                                    @error('newUsername')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group-append">
                                        <button type="button" wire:click="addUser" class="btn btn-primary"
                                            @if (!$selectedPackageId) disabled @endif>
                                            Add User
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <h5 class="card-title">Transaction details</h5>

                            {{-- <div class="form-group">
                                <label for="users">Added Users</label>
                                <div id="users">
                                    @foreach ($usernames as $index => $username)
                                        <div class="user mb-2">
                                            <div class="input-group">
                                                <input type="text" value="{{ $username }}" class="form-control" disabled>
                                                <div class="input-group-append">
                                                    <button type="button" wire:click="removeUser({{ $index }})"
                                                        class="btn btn-danger">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label for="users" class="col-sm-2 col-form-label">Added Users</label>
                                <div class="col-sm-10">
                                    <div id="users">
                                        @foreach ($usernames as $index => $username)
                                            <div class="input-group mb-3 user">
                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                <input type="text" value="{{ $username }}" class="form-control"
                                                    disabled>
                                                <div class="input-group-append">
                                                    <button type="button" wire:click="removeUser({{ $index }})"
                                                        class="btn btn-danger"
                                                        style="margin-left: 10px;">Remove</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Total Transaction <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ number_format($totalAmount, 0, ',', '.') }}"
                                        style="font-weight: bold;" class="form-control mb-3" disabled>
                                </div>
                            </div> --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Sub Total <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ number_format($subTotal, 0, ',', '.') }}"
                                        style="font-weight: bold;" class="form-control mb-3" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Unique Code <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ number_format($uniqueCode, 0, ',', '.') }}"
                                        style="font-weight: bold;" class="form-control mb-3" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Service Fee <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ number_format($ppn, 0, ',', '.') }}"
                                        style="font-weight: bold;" class="form-control mb-3" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Grand Total <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ number_format($grandTotal, 0, ',', '.') }}"
                                        style="font-weight: bold;" class="form-control mb-3" disabled>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-block w-100"
                                style="background-color: #012970;">Create Transaction</button>
                        </form>

                    </div>
                    <!-- End General Form Elements -->
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-4">

            <div class="card">
                <div class="card-body">
                    <div class="my-3 px-3 pb-0">
                        <h5 class="card-title">
                            <div class="alert alert-success">This is the quota package information that can be used for
                                a
                                number of reasons.</div>
                        </h5>

                        <div class="row mb-3">
                            {{~~ <label class="col-sm-2 col-form-label">Remaining Quota <span
                                    class="text-danger"></span></label> ~~}}
                            <div class="col-sm-10">
                                <label for="" class="mx-0 my-2 mt-0">Remaining Quota</label>
                                <input type="text" value="{{ $remainingQuota }}" style="font-weight: bold;"
                                    class="form-control mb-3" disabled>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div> --}}
    </div>
</section>
