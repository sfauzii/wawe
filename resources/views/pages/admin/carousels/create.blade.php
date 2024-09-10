@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Add Carousel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('carousels.index') }}">Home</a></li>
                <li class="breadcrumb-item">Carousel</li>
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

                        <div class="my-4 p-4">
                            <form action="{{ route('carousels.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="image_carousel">Image</label>
                                        <input type="file" name="image_carousel" class="form-control @error('image_carousel') is-invalid @enderror">
                            
                                        @error('image_carousel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="title_carousel">Title</label>
                                        <input type="text" name="title_carousel" class="form-control @error('title_carousel') is-invalid @enderror">
                            
                                        @error('title_carousel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="description_carousel">Description</label>
                                        <textarea name="description_carousel" class="form-control @error('description_carousel') is-invalid @enderror"></textarea>
                                        @error('description_carousel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </section>

    
@endsection


