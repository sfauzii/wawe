@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Permissions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Home</a></li>
                <li class="breadcrumb-item">Permission</li>
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

                        @can('create permission')
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-right" style="float: right; margin-top: -40px; margin-right: 10px">Add Permission</a>
                        @endcan

                        <!-- Table with stripped rows -->

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>

                                        <td>
                                            {{-- <a href="{{ route('permissions.show', encrypt($permission->id)) }}" class="btn btn-success">
                                                <i class="fa fa-pencil-alt">Show</i>
                                            </a> --}}
                                            {{-- <a href="{{ route('permissions.edit', encrypt($permission->id)) }}" class="btn btn-info">
                                                <i class="fa fa-pencil-alt">Edit</i>
                                            </a> --}}
                                            @can('edit permission')
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info">
                                                    <i class="ri-edit-line" style="color: white;"></i>
                                                </a>
                                            @endcan
                                            {{-- <a href="{{ route('permissions.delete', $permission->id) }}" class="btn btn-info">
                                                <i class="fa fa-pencil-alt">Delete</i>
                                            </a> --}}
                                            @can('delete permission')
                                                <form action="{{ route('permissions.destroy', $permission->id) }}"
                                                    method="POST" class="d-inline" id="delete-form-{{ $permission->id }}">

                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDeletion(' {{ $permission->id }} ', 'delete-form-{{ $permission->id }}')">
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
