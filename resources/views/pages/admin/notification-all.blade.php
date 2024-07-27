@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>List Group</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Notification</li>
                <li class="breadcrumb-item active">All</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Notifications</h5>

                        @livewire('notification-list')

                       
                    </div>
                </div>


            </div>



        </div>
    </section>
@endsection