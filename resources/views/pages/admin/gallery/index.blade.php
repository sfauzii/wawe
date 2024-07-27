@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Data Gallery</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Home</a></li>
                <li class="breadcrumb-item">Gallery</li>
                <li class="breadcrumb-item active">Data</li>
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
                                        <td>{{ $item->travel_package->title }}</td>
                                        <td>
                                            <img src="{{ Storage::url($item->image) }}" alt="" style="width: 150px"
                                                class="img-thumbnail" />
                                        </td>
                                        <td>
                                            <a href="{{ route('gallery.edit', encrypt($item->id)) }}" class="btn btn-info">
                                                <i class="fa fa-pencil-alt">Edit</i>
                                            </a>
                                            <form action="{{ route('gallery.destroy', encrypt($item->id)) }}" method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">
                                                    <i class="fa fas-trash">Delete</i>

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
