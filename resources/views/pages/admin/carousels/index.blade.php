@extends('layouts.admin')

@section('title', 'Carousels')


@section('content')
    <div class="pagetitle">
        <h1>Carousels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('carousels.index') }}">Home</a></li>
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

                        @can('create carousel')
                            <a href="{{ route('carousels.create') }}" class="btn btn-primary btn-right"
                                style="float: right; margin-top: -40px; margin-right: 10px">Add Carousel</a>
                        @endcan

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carousels as $carousel)
                                    <tr>
                                        <td><img src="{{ Storage::url($carousel->image_carousel) }}"
                                                alt="{{ ucwords($carousel->title_carousel) }}"
                                                style="width: 100px; height:auto;">
                                        </td>
                                        <td>{{ ucwords($carousel->title_carousel) }}</td>
                                        <td>{{ ucfirst($carousel->description_carousel) }}</td>
                                        <td>
                                            <form action="{{ route('carousels.toggleStatus', $carousel->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('POST')
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="statusSwitch{{ $carousel->id }}" onchange="this.form.submit()"
                                                        {{ $carousel->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="statusSwitch{{ $carousel->id }}"></label>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            @can('edit carousel')
                                                <a href="{{ route('carousels.edit', $carousel->id) }}" class="btn btn-info"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Carousel"
                                                    style="margin-bottom: 5px;"><i class="ri-edit-line"
                                                        style="color: white;"></i></a>
                                            @endcan

                                            @can('delete carousel')
                                                <form action="{{ route('carousels.destroy', $carousel->id) }}" method="POST"
                                                    class="d-inline" id="delete-form-{{ $carousel->id }}">

                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDeletion('{{ $carousel->id }}', 'delete-form-{{ $carousel->id }}')"
                                                        data-bs-placement="top" title="Delete Carousel"
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
