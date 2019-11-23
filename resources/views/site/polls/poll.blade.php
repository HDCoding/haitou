@extends('layouts.dashboard')

@section('subtitle', '')

@section('content')

    <div class="content content-narrow">

        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Pesquisa: </h3>
            </div>
            <div class="block-content">
                @includeIf('errors.errors', [$errors])
                <div class="panel panel-chat">
                    <div class="panel-heading">
                        <h1 class="panel-title">{{ $poll->name }}</h1>
                    </div>

                    <div class="panel-body">

                        {!! Form::open(['url' => 'poll/' . $poll->id, 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <div class="col-xs-12">
                                @foreach ($poll->poll_options as $option)
                                    @if($poll->multivote)
                                        <div class="checkbox">
                                            <label for="option-checkbox-{{ $option->id }}">
                                                <input type="checkbox" id="option-checkbox-{{ $option->id }}" name="option[]" value="{{ $option->id }}"> {{ $option->option }}
                                            </label>
                                        </div>
                                    @else
                                        <div class="radio">
                                            <label for="option-radio-{{ $option->id }}">
                                                <input type="radio" id="option-radio-{{ $option->id }}" name="option" value="{{ $option->id }}"> {{ $option->option }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-6">
                                {!! Form::submit('Votar', ['class' => 'btn  btn-primary btn-rounded btn-outline']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
