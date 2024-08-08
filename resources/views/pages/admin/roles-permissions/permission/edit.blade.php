@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Edit Permission</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Home</a></li>
                <li class="breadcrumb-item">Permission</li>
                {{-- <li class="breadcrumb-item active">Elements</li> --}}
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
                        <div class="alert alert-warning my-4"><strong class="font-size: 12px;">Warning</strong> <br>
                            By editing the permission name, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.</div>

                        <!-- General Form Elements -->
                        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name  <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $permission->name }}">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block w-100">
                                Update
                            </button>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>


        </div>
    </section>
@endsection
