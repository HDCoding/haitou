@extends('layouts.auth')

@section('title', 'Ativação')

@section('styles')
    <!-- Page -->
    <link href="{{ asset('css/pages/authentication.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- Content -->

    <div class="authentication-wrapper authentication-2 px-4">
        <div class="authentication-inner py-5">

            <!-- Card -->
            <div class="card">
                <div class="p-4 p-sm-5">

                    <div class="display-1 lnr lnr-checkmark-circle text-center text-success mb-4"></div>

                    <p class="text-center text-big mb-4">
                        @include('includes.messages')
                    </p>

                    <a href="{{ url('login') }}" type="button" class="btn btn-primary btn-block">Prosseguir</a>

                </div>
            </div>
            <!-- / Card -->

        </div>
    </div>

    <!-- / Content -->

@endsection
