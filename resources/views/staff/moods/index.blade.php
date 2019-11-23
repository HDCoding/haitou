@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.moods'))

@section('css')
    <!-- X-Editable -->
    <link href="{{ asset('vendor/x-editable/dist/css/bootstrap-editable.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.moods')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <span class="card-header-title mr-2">Moods</span>
        </div>
        <div class="card-datatable table-responsive">
            <div class="text-center">
                <b class="text-danger">OBS:</b>
                <b>Nome</b> = max: 45 caracteres - <b>Pontos</b> = min: 1 - max 120
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center"><i class="fa fa-smile-wink"></i></th>
                        <th>Nome</th>
                        <th>Pontos</th>
                    {{--<th class="text-center">Opções</th>--}}
                    </tr>
                </thead>
                <tbody>
                @foreach($moods as $mood)
                    <tr>
                        <td class="text-center">
                            <img class="img-avatar img-avatar48" src="{{ $mood->image() }}" alt="">
                        </td>
                        <td><a href="#" class="MoodText" id="name" data-type="text" data-column="name" data-title="Editar Mood" data-name="name" data-value="{{ $mood->name }}" data-pk="{{ $mood->id }}" data-url="{{ route('moods.update', ['id' => $mood->id]) }}">{{ $mood->name }}</a></td>
                        <td><a href="#" class="MoodNumber" id="points" data-type="number" data-column="points" data-title="Editar Ponto" data-name="points" data-value="{{ $mood->points }}" data-pk="{{ $mood->id }}" data-url="{{ route('moods.update', ['id' => $mood->id]) }}">{{ $mood->points }}</a></td>
{{--                            <td class="text-center">--}}
{{--                                <div class="btn-group">--}}
{{--                                    <a href="javascript:;" onclick="document.getElementById('mood-del-{{ $mood->id }}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover"><i class="fa fa-times text-danger"></i></a>--}}
{{--                                    {!! Form::open(['url' => 'moods/' . $mood->id, 'method' => 'DELETE', 'id' => 'mood-del-' . $mood->id , 'style' => 'display: none']) !!}--}}
{{--                                    {!! Form::close() !!}--}}
{{--                                </div>--}}
{{--                            </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <!-- X-Editable -->
    <script src="{{ asset('vendor/x-editable/dist/js/bootstrap-editable.min.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.MoodText').editable({
                mode: 'inline',
                type: 'text',
                min: 1,
                max: 45,
                ajaxOptions: {
                    type: 'put',
                    dataType: 'json'
                },
                validate:function(string){
                    if ($.trim(string) === '') {
                        return "Campo é obrigatório";
                    }
                    let texto = $.trim(string.length);
                    if (texto <= 0 || texto >= 46) {
                        return "Minimo 1 e Máximo de 45 caracteres.";
                    }
                },
                success:function(data){
                    console.log(data);
                } ,
                error:function(data) {
                    console.log(data);
                }
            });
            $('.MoodNumber').editable({
                mode: 'inline',
                type: 'number',
                min: '1',
                max: '120',
                ajaxOptions: {
                    type: 'put',
                    dataType: 'json'
                },
                validate:function(number){
                    if ($.trim(number) === '') {
                        return "Campo é obrigatório";
                    }
                },
                success:function(data){
                    console.log(data);
                } ,
                error:function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
