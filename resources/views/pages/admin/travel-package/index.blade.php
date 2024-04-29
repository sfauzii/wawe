@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Data Travel Package</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Home</a></li>
                <li class="breadcrumb-item">Travel Package</li>
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
                        <h5 class="card-title">Travel Package</h5>
                        <p>Add lightweight datatables to your project with using the <a
                                href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple
                                DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to
                            conver to a datatable. Check for <a
                                href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more
                                examples</a>.</p>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    {{-- <th data-type="date" data-format="YYYY/DD/MM">Start Date</th> --}}
                                    <th>Departure Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->departure_date }}</td>
                                        <td>
                                            <a href="{{ route('travel-package.edit', $item->id) }}" class="btn btn-info">
                                                <i class="fa fa-pencil-alt">Edit</i>
                                            </a>
                                            <form action="{{ route('travel-package.destroy', $item->id) }}" method="POST"
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
