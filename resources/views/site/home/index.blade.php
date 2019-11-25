@extends('layouts.dashboard')

@section('subtitle', 'Home')

@section('css')
    <link href="{{ asset('vendor/vegas/vegas.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="demo-vertical-spacing mb-4">
        <div id="home-cover" class="vegas-fixed-background">
            <h4 class="text-center text-dark py-4 my-5">Home</h4>
        </div>
    </div>

    <hr class="border-light container-m--x mt-0 mb-4">

    Sem ideias do que colocar na Home <br>
    Uma ajuda por favor :(

@endsection

@section('script')
    <!-- VegasJS -->
    <script src="{{ asset('vendor/vegas/vegas.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(function() {
            // Fixed bg
            $('#home-cover').vegas({
                overlay: false,
                timer: false,
                shuffle: true,
                slides: [
                    { src: "{{ asset('images/home.jpg') }}" },
                ],
                transition: ['fade', 'zoomOut', 'zoomIn', 'blur'],
                animation: ['kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight']
            });
        });
    </script>

@endsection
