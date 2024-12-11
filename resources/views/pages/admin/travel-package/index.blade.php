@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Travel Packages</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Home</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <h5 class="card-title"></h5>

                        @can('create package')
                            <a href="{{ route('travel-package.create') }}" class="btn btn-primary btn-right"
                                style="float: right; margin-top: -40px; margin-right: 10px">Add Package</a>
                        @endcan

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    {{-- <th>Kuota</th> --}}
                                    <th>Departure Date</th>
                                    <th>Gallery</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($item->title) }}</td>
                                        <td>{{ ucwords($item->location) }}</td>
                                        <td>{{ ucwords($item->type) }}</td>
                                        <td>{{ number_format($item->price, 0, ' ') }}</td>
                                        {{-- <td>{{ $item->kuota }}</td> --}}
                                        <td>{{ $item->departure_date }}</td>
                                        <td>
                                            @forelse ($item->galleries as $gallery)
                                                @foreach ($gallery->image as $image)
                                                    <img src="{{ Storage::url($image) }}" alt="Image"
                                                        style="width: 80px; height: 80px; border-radius: 50%; margin-right: 5px; object-fit: cover;"
                                                        class="img-thumbnail" />
                                                @endforeach
                                            @empty
                                                <p>No images</p>
                                            @endforelse
                                        </td>
                                        <td>
                                            <form action="{{ route('travel-packages.toggleStatus', $item->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('POST')
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="statusSwitch{{ $item->id }}" onchange="this.form.submit()"
                                                        {{ $item->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="statusSwitch{{ $item->id }}"></label>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            @can('view package')
                                                <a href="{{ route('travel-package.show', encrypt($item->id)) }}"
                                                    class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Show Package" style="margin-bottom: 5px;">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            @endcan

                                            @can('edit package')
                                                <a href="{{ route('travel-package.edit', encrypt($item->id)) }}"
                                                    class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit Package" style="margin-bottom: 5px;">
                                                    <i class="ri-edit-line" style="color: white;"></i>
                                                </a>
                                            @endcan

                                            @can('delete package')
                                                <form action="{{ route('travel-package.destroy', encrypt($item->id)) }}"
                                                    method="POST" class="d-inline" id="delete-form-{{ $item->id }}">

                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDeletion('{{ encrypt($item->id) }}', 'delete-form-{{ $item->id }}')"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Package"
                                                        style="margin-bottom: 5px;">
                                                        <i class="ri-delete-bin-6-line"></i>

                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Data kosong
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
