@extends('layouts.dashboard')

@section('title', 'Free Slots')

@section('css')
    <link href="{{ asset('vendor/c3/c3.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Free Slots</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Site Points</h4>
                        @if($freeslot != false)
                            @if($freeslot->is_active == true)
                            <h4 class="card-title">Uma vez que o Site Points tiverem
                                <b class="text-danger">{{ number_format($freeslot->required) }}</b> pontos, o
                                <b class="text-danger">{{ $freeslot->type() }}</b> estará liberado para todos por
                                <b class="text-danger">{{ $freeslot->days }}</b> dias.</h4>

                            <p class="card-text">Pontos: {{ number_format($freeslot->actual) }} / {{ number_format($freeslot->required) }}</p>

                            <div class="demo-vertical-spacing-lg">
                                <div id="c3-gauge" style="height: 300px"></div>
                            </div>

                            <hr class="border-light container-m--x my-0">
                            @includeIf('errors.errors', [$errors])
                            @include('includes.messages')
                            {!! Form::open(['url' => 'freeslots', 'class' => 'mt-4 container col-md-5 col-md-offset-4']) !!}
                            {!! Form::hidden('freeslot_id', $freeslot->id) !!}
                            <div class="form-group row ml-5">
                                {!! Form::label('point', 'Quantia:', ['class' => 'col-form-label col-sm-2 text-sm-right']) !!}
                                <div class="col-sm-4">
                                    {!! Form::number('point', null, ['class' => 'form-control', 'placeholder' => 'Pontos', 'min' => 1, 'max' => 1000, 'required']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::submit('Doar', ['class' => 'btn btn-primary btn-rounded btn-outline']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @endif
                        @else
                            <div class="block-header">
                                <h3 class="block-title text-center mt-5 mb-5">Fechado!</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Quem mais contribuiu</h4>
                        <h6 class="card-subtitle">Using the most basic table markup, here’s tables look in Bootstrap. All table styles are inherited in Bootstrap 4, meaning any nested tables will be styled in the same manner as the parent.</h6>
                        <h6 class="card-title m-t-40"><i class="m-r-5 font-18 fa fa-heart text-danger"></i> Coracao</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Nick</th>
                                    <th scope="col">Valor</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Mark</th>
                                    <td>100</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('vendor/c3/c3.min.js') }}"></script>
    <script src="{{ asset('vendor/c3/d3.min.js') }}"></script>
    @if($freeslot != false)
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $(function() {
                c3.generate({
                    bindto: '#c3-gauge',
                    data: {
                        columns: [
                            ['porcentagem', {{ $freeslot->percent() }}]
                        ],
                        type: 'gauge'
                    },
                    gauge: {
                        label: {
                            format: function(value, ratio) {
                                return value;
                            },
                            show: true // to turn off the min/max labels.
                        },
                        min: 0,
                        max: 100,
                        // units: '%',
                        width: 50 // for adjusting arc thickness
                    },
                    color: {
                        pattern: ['#FF0000', '#F97600', '#F6C600', '#60B044'],
                        threshold: {
                            values: [30, 60, 90, 100]
                        }
                    },
                    size: {
                        height: 300
                    }
                });
            });
        });
    </script>
    @endif
@endsection
