@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Data User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Home</a></li>
                <li class="breadcrumb-item">User</li>
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

                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-right" style="float: right; margin-top: -40px; margin-right: 10px">Add User</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    {{-- <th data-type="date" data-format="YYYY/DD/MM">Start Date</th> --}}
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->roles) && $user->roles->count() > 0)
                                                @foreach ($user->roles as $role)
                                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-black">No roles assigned</span>
                                            @endif
                                        </td>

                                        {{-- <td>
                                            @if ($user->roles === 'ADMIN')
                                                <span class="badge rounded-pill text-bg-success">{{ $user->roles }}</span>
                                            
                                            @else
                                                <span class="badge rounded-pill text-bg-dark">{{ $user->roles }}</span>
                                            @endif --}}
                                        </td>
                                        <td>
                                            <a href="{{ route('user.show', encrypt($user->id)) }}" class="btn btn-success">
                                                <i class="fa fa-eye">Show</i>
                                            </a>

                                            @can('edit user')
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info">
                                                    <i class="fa fa-pencil-alt">Edit</i>
                                                </a>
                                            @endcan

                                            @can('delete user')
                                                <form action="{{ route('user.destroy', encrypt($user->id)) }}" method="POST"
                                                    class="d-inline">

                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">
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
