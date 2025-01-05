@extends('layouts.admin')

@section('title', 'Users')


@section('content')
    <div class="pagetitle">
        <h1>Add User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
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

                        <!-- General Form Elements -->
                        <div class="my-4 p-4 pb-0">
                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">Username <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            name="username" placeholder="Username" value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-sm-2 col-form-label">Password <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input name="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Password <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input name="password_confirmation" type="password" placeholder="Confirm Password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            autocomplete="new-password">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Roles <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select name="roles[]" class="form-control @error('roles') is-invalid @enderror"
                                            multiple>
                                            <option value="">Select Roles</option>
                                            @foreach ($roles as $id => $role)
                                                <option value="{{ $id }}"
                                                    {{ old('roles') && in_array($id, old('roles')) ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error('roles.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                    <label for="photos" class="col-sm-2 col-form-label">Photos</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="photos" class="form-control" accept="image/*">
                                    </div>
                                </div> --}}



                                <button type="submit" class="btn btn-primary btn-block w-100">
                                    Simpan
                                </button>
                            </form>
                        </div>
                        <!-- End General Form Elements -->

                    </div>
                </div>

            </div>


        </div>
    </section>
@endsection
