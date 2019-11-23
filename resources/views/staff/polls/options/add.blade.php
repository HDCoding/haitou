@extends('layouts.dashboard')

@section('subtitle', 'Pesquisas')

@section('content')

        <div class="font-weight-bold py-3 h4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('staff/polls') }}">Pesquisas</a>
                </li>
                <li class="breadcrumb-item active">Adicionar Opções</li>
            </ol>
        </div>

        <hr class="container-m-nx border-light mt-0 mb-5">

        <div class="card mb-4">
            <h6 class="card-header"><b>Pergunta: </b> {{ $poll->name }}</h6>
            <div class="card-body">

                @includeIf('errors.errors', [$errors])
                {!! Form::open(['url' => 'staff/poll/options/add', 'class' => 'form-horizontal push-5-t']) !!}
                {!! Form::hidden('poll_id', $poll->id) !!}

                <div class="form-group after-add-more">
                    {!! Form::label('option', 'Opção: *', ['class' => 'col-xs-12']) !!}
                    <div class="input-group">
                        {!! Form::text('option[]', null, ['class' => 'form-control', 'maxlength' => 250, 'required']) !!}
                        <span class="input-group-btn">
                            <button class="btn btn-success add-more" type="button">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <br>
                {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
                <br>
            {!! Form::close() !!}

            <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input -->
                <div class="form-group copy-fields" id="hide" style="display: none">
                    <label for="option" class="col-xs-12">Opção: *</label>
                    <div class="form-group control-group input-group">
                        <input id="option" type="text" name="option[]" class="form-control" maxlength="255" required>
                        <div class="input-group-btn">
                            <button class="btn btn-danger remove" type="button">
                                <i class="fa fa-minus-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

@endsection

@section('script')
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
