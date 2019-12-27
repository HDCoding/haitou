@extends('layouts.dashboard')

@section('title', 'Adicionar Opções')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/polls') }}">@lang('dashboard.polls')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar Opções</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Adicionar Opções</h4>
                        @includeIf('errors.errors', [$errors])
                        {!! Form::open(['url' => 'staff/poll/options/add', 'class' => 'form-horizontal push-5-t']) !!}
                        {!! Form::hidden('poll_id', $poll->id) !!}

                        <div class="form-group after-add-more">
                            {!! Form::label('options', 'Opção: *', ['class' => 'col-xs-12']) !!}
                            <div class="input-group">
                                {!! Form::text('options[]', null, ['class' => 'form-control', 'maxlength' => 250, 'required']) !!}
                                <span class="input-group-btn">
                                    <button class="btn btn-success add-more" type="button">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <br>
                        {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded']) !!}
                        {!! Form::close() !!}

                        <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input -->
                        <div class="form-group copy-fields" id="hide" style="display: none">
                            <label for="options" class="col-xs-12">Opção: *</label>
                            <div class="form-group control-group input-group">
                                <input id="options" type="text" name="options[]" class="form-control" maxlength="255" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-danger remove" type="button">
                                        <i class="fa fa-minus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
            $(".add-more").click(function(){
                var html = $('#hide').html();
                $(".after-add-more").after(html);
            });
            //here it will remove the current value of the remove button which has been pressed
            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });
        });
    </script>
@endsection
