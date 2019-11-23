@extends('layouts.dashboard')

@section('subtitle', 'Bonus')

@section('css')
    <!-- select2 -->
    <link href="{{ asset('vendor/select2/select2.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <span class="text-muted font-weight-light">Bonus</span>
    </div>

    @includeIf('errors.errors', [$errors])
    @include('includes.messages')

    <div class="card mb-5">
        <div class="card-header text-center">
            Doação
        </div>
        <div class="card-body">
            <h4 class="card-title text-center">Doar meus pontos</h4>
            <p class="card-text text-center">Ta com pontos sobrando, doe para seus amigos.</p>

            <!-- Filters -->
            <div class="ui-bordered px-4 pt-4 mb-4">
                {!! Form::open(['url' => 'bonus/donate']) !!}
                <div class="form-row align-items-center">
                    <div class="col-md mb-4">
                        {!! Form::label('user_id', 'Membro:', ['class' => 'form-label']) !!}
                        {!! Form::select('user_id', $members, null, ['class' => 'custom-select select2', 'required']) !!}
                    </div>
                    <div class="col-md mb-4">
                        {!! Form::label('quantity', 'Quantidade:', ['class' => 'form-label']) !!}
                        {!! Form::number('quantity', null, ['class' => 'form-control', 'min' => 1, 'required']) !!}
                    </div>
                    <div class="col-md col-xl-2 mb-4">
                        <label class="form-label d-none d-md-block">&nbsp;</label>
                        <button type="submit" class="btn btn-secondary btn-block">Doar</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- / Filters -->
        </div>
    </div>

    <div class="card">
        <div class="card-header text-center">
            Bonus
        </div>
        <div class="card-body">
            <h4 class="card-title text-center">Aviso</h4>
            <p class="card-text text-center">Trocas são finais, por favor, verifique suas escolhas antes de fazer uma troca. <b class="text-danger">SEM REEMBOLSO!</b></p>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th class="hidden-xs" style="width: 10%;">Custo</th>
                        <th class="hidden-xs" style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($points as $point)
                    <tr>
                        <td>
                            <p><strong>{{ $point->name }}</strong></p>
                            <p class="text-muted">{{ $point->description }}</p>
                        </td>
                        <td class="hidden-xs">
                            <span class="badge badge-outline-success">{{ $point->cost }}</span>
                        </td>
                        <td class="hidden-xs">
                            {!! Form::open(['url' => 'bonus']) !!}
                            {!! Form::hidden('bonus_id', $point->id) !!}
                            {!! Form::submit('Escolher', ['class' => 'btn btn-primary btn-outline-primary', 'data-toggle' => 'tooltip', 'title' => 'Escolher']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $(".select2").select2({
                placeholder: "Selecione um membro",
                allowClear: true
            });
        });
    </script>
@endsection
