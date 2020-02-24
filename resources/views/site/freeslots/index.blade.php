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
                @includeIf('errors.errors', [$errors])
                @include('includes.messages')
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

                            {!! Form::open(['url' => 'freeslots/'. $freeslot->id, 'class' => 'mt-4 container col-md-5 col-md-offset-4']) !!}
                            <div class="form-group row ml-5">
                                {!! Form::label('point', 'Quantia:', ['class' => 'col-form-label col-sm-2 text-sm-right']) !!}
                                <div class="col-sm-4">
                                    {!! Form::number('point', null, ['class' => 'form-control', 'placeholder' => 'Pontos', 'min' => 1, 'max' => 1000, 'required']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::submit('Doar', ['class' => 'btn btn-primary btn-rounded mt-4']) !!}
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
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Quem mais contribuiu <i class="m-l-5 fa fa-heart text-danger"></i></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nick</th>
                                        <th scope="col">Pontos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @if(!empty($helpers))
                                        @forelse($helpers as $helper)
                                            <th scope="row">
                                                {{ link_to_route('user.profile', $helper->username, [strtolower($helper->username)], ['target' => '_blank']) }}
                                            </th>
                                            <td>{{ $helper->total }}</td>
                                        @empty
                                            <th scope="row" colspan="2" class="text-center font-weight-bold">
                                                Ninguém contribuiu até no momento. Seja a(o) primeira(o).
                                            </th>
                                        @endforelse
                                    @endif
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
                            values: [25, 50, 75, 100]
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
