@extends('layouts.dashboard')

@section('subtitle', 'Anotações ao Usuário')

@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/users') }}">@lang('dashboard.users')</a>
            </li>
            <li class="breadcrumb-item active">Anotações</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <p class="card-header">Anotações ao usuário: <b>{{ $user->name }}</b></p>
        <div class="card-body">

            <div class="block">
                <div class="block-content">
                    @includeIf('errors.errors', [$errors])
                    {!! Form::open(['url' => 'staff/user/notes', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('user_id', $user->id) !!}
                    <div class="form-group">
                        {!! Form::label('description', 'Anotação: *') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
                    </div>
                    {!! Form::submit('Salvar', ['class' => 'btn btn-success btn-rounded btn-outline']) !!}
                    <br>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>

    <div id="note">
        @foreach($notes as $note)
            <div class="card mb-2">
                <div class="card-header">
                    <a class="text-body" data-toggle="collapse" href="#note-{{ $note->id }}">
                        {{ $note->created_at->format('d/m/Y') }} || Por {{ $note->staff->name }}
                    </a>
                </div>

                <div id="note-{{ $note->id }}" class="collapse" data-parent="#note">
                    <div class="card-body">
                        {!! $note->descriptionHtml() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('script')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>
    <!-- Page JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            //terms
            var textarea = document.getElementById('description');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
