@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Galleries</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Home</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="row">
        @foreach ($packages as $package)
            <div class="col-xxl-4 col-md-6 mb-4">
                <div class="card info-card sales-card h-100">
                    <div class="card-body d-flex">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">

                        </div>
                        <div>
                            <h5 class="card-title"></h5>
                            <div class="d-flex align-items-center">
                                <div class="ps-3">
                                    <h1 style="font-weight: bold; color: #012970">{{ $package->galleries_count }}</h1>
                                    <span class="text-muted large pt-1 ps-1" style="font-size: 14px; font-weight: 500;">Gallery in</span>
                                    <span class="text-success small pt-2 fw-bold">{{ ucwords($package->title) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <h5 class="card-title"></h5>
                        <a href="{{ route('gallery.create') }}" class="btn btn-primary btn-right" style="float: right; margin-top: -40px; margin-right: 10px">Add Gallery</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>Travel</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($item->travel_package->title) }}</td>
                                        <td>
                                            @foreach ($item->image as $image)
                                                <img src="{{ Storage::url($image) }}" alt="Image" style="width: 80px; height: 80px; border-radius: 50%; margin-right: 5px; object-fit: cover;"  class="img-thumbnail" />
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('gallery.edit', encrypt($item->id)) }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Gallery">
                                                <i class="ri-edit-line" style="color: white;"></i>
                                            </a>
                                            <form action="{{ route('gallery.destroy', encrypt($item->id)) }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger" onclick="confirmDeletion('{{ encrypt($item->id) }}', 'delete-form-{{ $item->id }}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Gallery">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </button>
                                            </form>
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
