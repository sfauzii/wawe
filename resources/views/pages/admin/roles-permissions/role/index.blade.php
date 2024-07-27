@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Data Role</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Home</a></li>
                <li class="breadcrumb-item">Role</li>
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
                        <h5 class="card-title">Role</h5>
                        @can('create role')
                        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-right" style="float: right; margin-top: -40px; margin-right: 10px">Add Role</a>
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
                                @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>

                                        <td>
                                            {{-- <a href="{{ route('roles.show', encrypt($role->id)) }}" class="btn btn-success">
                                                <i class="fa fa-pencil-alt">Show</i>
                                            </a> --}}
                                            {{-- <a href="{{ route('roles.edit', encrypt($role->id)) }}" class="btn btn-info">
                                                <i class="fa fa-pencil-alt">Edit</i>
                                            </a> --}}
                                            @can('manage-role-permission')
                                            <a href="{{ route('roles.give-permission', $role->id) }}"
                                                class="btn btn-success">
                                                <i class="fa fa-pencil-alt">Manage</i>
                                            </a>
                                            @endcan


                                            @can('edit role')
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">
                                                    <i class="fa fa-pencil-alt">Edit</i>
                                                </a>
                                            @endcan

                                            {{-- <a href="{{ route('roles.delete', $role->id) }}" class="btn btn-info">
                                                <i class="fa fa-pencil-alt">Delete</i>
                                            </a> --}}


                                            @can('delete role')
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                    class="d-inline" id="delete-form-{{ $role->id }}">

                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDeletion(' {{ $role->id }} ', 'delete-form-{{ $role->id }}')">
                                                        <i class="fa fas-trash">Delete</i>
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
