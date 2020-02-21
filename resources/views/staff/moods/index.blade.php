@extends('layouts.dashboard')

@section('title', trans('dashboard.moods'))

@section('css')
    <!-- X-Editable -->
    <link href="{{ asset('vendor/x-editable/dist/css/bootstrap-editable.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link href="{{ asset('vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.moods')</li>
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
                        <h4 class="card-title">@lang('dashboard.moods')</h4>
                        <div class="text-center">
                            <b class="text-danger">OBS:</b>
                            <b>Nome</b> = max: 45 caracteres - <b>Pontos</b> = min: 1 - max 120
                        </div>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Pontos</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($moods as $mood)
                                    <tr>
                                        <th>
                                            <img class="img-avatar img-avatar48" src="{{ $mood->image() }}" alt="Mood">
                                        </th>
                                        <td>
                                            <a href="#" class="MoodText" id="name" data-type="text" data-column="name"
                                               data-title="Editar Mood" data-name="name" data-value="{{ $mood->name }}"
                                               data-pk="{{ $mood->id }}"
                                               data-url="{{ route('moods.update', $mood->id) }}">{{ $mood->name }}</a>
                                        </td>
                                        <td>
                                            <a href="#" class="MoodNumber" id="points" data-type="number"
                                               data-column="points" data-title="Editar Ponto" data-name="points"
                                               data-value="{{ $mood->points }}" data-pk="{{ $mood->id }}"
                                               data-url="{{ route('moods.update', $mood->id) }}">{{ $mood->points }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- X-Editable -->
    <script src="{{ asset('vendor/x-editable/dist/js/bootstrap-editable.min.js') }}"></script>
    <!-- DataTable -->
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('#datatable').DataTable({
                "displayLength": 50,
                "searching": true,
                "responsive": true,
                "order": [[1, "asc"]],
                "language": {
                    "url": '{{ asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });

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
                validate: function (string) {
                    if ($.trim(string) === '') {
                        return "Campo é obrigatório";
                    }
                    let texto = $.trim(string.length);
                    if (texto <= 0 || texto >= 46) {
                        return "Minimo 1 e Máximo de 45 caracteres.";
                    }
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
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
                validate: function (number) {
                    if ($.trim(number) === '') {
                        return "Campo é obrigatório";
                    }
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    </script>

@endsection
