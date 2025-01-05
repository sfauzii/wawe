@extends('layouts.admin')

@section('title', 'Users')


@section('content')
    <div class="pagetitle">
        <h1>Users</h1>
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

                        @can('create user')
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-right"
                                style="float: right; margin-top: -40px; margin-right: 10px">Add User</a>
                        @endcan
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
                                        <td>{{ ucwords($user->name) }}</td>
                                        <td>{{ '@' . $user->username }}</td>
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
                                            @can('view user')
                                                <a href="{{ route('user.show', encrypt($user->id)) }}" class="btn btn-success"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Show User">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            @endcan

                                            @can('edit user')
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User">
                                                    <i class="ri-edit-line" style="color: white;"></i>
                                                </a>
                                            @endcan

                                            @can('delete user')
                                                <form action="{{ route('user.destroy', encrypt($user->id)) }}" method="POST"
                                                    class="d-inline" id="delete-form-{{ $user->id }}">

                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDeletion('{{ encrypt($user->id) }}', 'delete-form-{{ $user->id }}')"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete User">
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
