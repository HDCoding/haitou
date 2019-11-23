@extends('layouts.dashboard')

@section('subtitle', 'Account settings')

@section('css')
    <!-- DateTimePicker -->
    <link href="{{ asset('vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        Account settings
    </div>

    @includeIf('errors.errors', [$errors])
    {!! Form::model(['url' => 'user/edit/account', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'account', 'name' => 'account']) !!}
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            @include('site.users.list-links')
            <div class="col-md-9">
                <div class="tab-content">

                    <div class="card-body media align-items-center">
                        <img src="{{ auth()->user()->getAvatar() }}" alt="" class="d-block ui-w-80">
{{--                            <div class="media-body ml-4">--}}
{{--                                <label class="btn btn-outline-primary">--}}
{{--                                    Upload new photo--}}
{{--                                    <input type="file" class="account-settings-fileinput">--}}
{{--                                </label> &nbsp;--}}
{{--                                <button type="button" class="btn btn-default md-btn-flat">Reset</button>--}}

{{--                                <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>--}}
{{--                            </div>--}}
                    </div>
                    <hr class="border-light m-0">

                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('state_id', 'Estado:', ['class' => 'form-label']) !!}
                            {!! Form::select('state_id', $states, auth()->user()->state_id, ['class' => 'custom-select']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('mood_id', 'Humor:', ['class' => 'form-label']) !!}
                            {!! Form::select('mood_id', $moods, auth()->user()->mood_id, ['class' => 'custom-select']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('avatar', 'Avatar:', ['class' => 'form-label']) !!}
                            {!! Form::text('avatar', auth()->user()->avatar, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cover', 'Cover:', ['class' => 'form-label']) !!}
                            {!! Form::text('cover', auth()->user()->cover, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('birthday', 'Nascimento:', ['class' => 'form-label']) !!}
                            {!! Form::text('birthday', auth()->user()->birthday->format('Y-m-d'), ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('info', 'Info:', ['class' => 'form-label']) !!}
                            {!! Form::textarea('info', auth()->user()->info, ['class' => 'form-control', 'rows' => 3]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('signature', 'Assinatura (Fórum):', ['class' => 'form-label']) !!}
                            {!! Form::textarea('signature', auth()->user()->signature, ['class' => 'form-control', 'rows' => 8]) !!}
                        </div>
                        <br>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="text-right mt-3">
        <button type="submit" class="btn btn-primary">Salvar alterações</button>&nbsp;
        <button type="button" class="btn btn-default">Cancelar</button>
    </div>
    {!! Form::close() !!}

@endsection

@section('script')
    <!-- DateTimePicker -->
    <script src="{{ asset('vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <!-- datepicker -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('#birthday').datepicker({
                format: 'yyyy-mm-dd',
                language: 'pt-BR',
                autoclose: true
            });
        });
    </script>
@endsection
