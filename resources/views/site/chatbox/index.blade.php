@extends('layouts.dashboard')

@section('title', 'Chat')

@section('css')
    <style>
        #footer {
            display: none;
        }
    </style>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
@endsection

@section('content')

    <chat-app :chatroom="{{ auth()->user()->chatrooms()->first() }}" :user="{{ auth()->user() }}"></chat-app>

@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
