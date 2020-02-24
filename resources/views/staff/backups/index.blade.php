@extends('layouts.dashboard')

@section('title', trans('dashboard.backups'))

@section('css')
    <!-- Ladda -->
    <link rel="stylesheet" href="{{ asset('vendor/ladda/ladda.css') }}">
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.backups')</li>
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
                        <h4 class="card-title">@lang('dashboard.backups')</h4>
                        <button id="create-full-backup-button" href="{{ url('staff/backups/create-full') }}" class="btn btn-primary ladda-button" data-style="zoom-in">
                            <span class="ladda-label"><i class="fa fa-plus"></i> Backup Completo</span>
                        </button>
                        <button id="create-files-backup-button" href="{{ url('staff/backups/create-files') }}" class="btn btn-success ladda-button" data-style="zoom-in">
                            <span class="ladda-label"><i class="fa fa-plus"></i> Backup dos Arquivos</span>
                        </button>
                        <button id="create-db-backup-button" href="{{ url('staff/backups/create-db') }}" class="btn btn-danger ladda-button" data-style="zoom-in">
                            <span class="ladda-label"><i class="fa fa-plus"></i> Banco do DB</span>
                        </button>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Diretório</th>
                                    <th>Data</th>
                                    <th>Tamanho do arquivo</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['backups'] as $key => $backup)
                                    <tr class="odd gradeX">
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td class="">{{ $backup['disk'] }}</td>
                                        <td>
                                            {{ format_date_time($backup['last_modified'])}}
                                        </td>
                                        <td>{{ make_size($backup['file_size']) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @if($backup['download'])
                                                    <a href="{{ url('staff/backups/download') }}?disk={{ $backup['disk'] }}&path={{ urlencode($backup['file_size']) }}&file_name={{ urlencode($backup['file_name']) }}"
                                                       data-toggle="tooltip" title="Download">
                                                        <button type="button" class="btn btn-xs btn-primary">
                                                            <i class="fas fa-cloud-download-alt"></i> Download
                                                        </button>
                                                    </a>
                                                @endif
                                                <a class="m-l-10" data-disk="{{ $backup['disk'] }}" data-file="{{ $backup['file_name'] }}" data-button-type="delete"
                                                   href="{{ url('staff/backups/delete') }}" data-toggle="tooltip" title="Delete">
                                                    <button type="button" class="btn btn-xs btn-danger">
                                                        <i class="fas fa-trash"></i> Deletar
                                                    </button>
                                                </a>
                                            </div>
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
    <script src="{{ asset('vendor/spin/spin.js') }}"></script>
    <script src="{{ asset('vendor/ladda/ladda.js') }}"></script>
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        jQuery(document).ready(function ($) {
            //DataTables
            $('#datatable').DataTable({
                "displayLength": 50,
                "searching": true,
                "responsive": true,
                "order": [[ 1, "asc" ]],
                "language": {
                    "url": '{{ asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });
            //capture the create full backup button
            $("#create-full-backup-button").click(function (e) {
                e.preventDefault();
                let create_backup_url = $(this).attr('href');
                //create a new instance of ladda for the specified button
                let l = Ladda.create(document.querySelector('#create-full-backup-button'));
                //start loading
                l.start();
                //will display a progress bar for 10% of the button width
                l.setProgress(0.3);
                setTimeout(function () {
                    l.setProgress(0.6)
                }, 2000);
                //do the backup through ajax
                $.ajax({
                    url: create_backup_url,
                    data: {_token: '{{ csrf_token() }}'},
                    type: 'POST',
                    success: function (result) {
                        l.setProgress(0.9);
                        //show an alert with the result
                        if (result.indexOf('failed') >= 0) {
                            toastr.warning('Seu backup NÃO pode ter sido criado. Verifique os arquivos de log para obter detalhes.', '', {timeOut: 6000});
                        } else {
                            toastr.success('Recarregando a página em 3 segundos.', '', {timeOut: 5000});
                        }
                        //stop loading
                        l.setProgress(1);
                        l.stop();
                        //refresh the page to show the new file
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function (result) {
                        l.setProgress(0.9);
                        //show an alert with the result
                        toastr.warning('O arquivo de backup NÃO pôde ser criado.', '', {timeOut: 5000});
                    }
                });
            });

            // capture the Create files backup button
            $("#create-files-backup-button").click(function (e) {
                e.preventDefault();
                let create_backup_url = $(this).attr('href');
                // Create a new instance of ladda for the specified button
                let l = Ladda.create(document.querySelector('#create-files-backup-button'));
                // Start loading
                l.start();
                // Will display a progress bar for 10% of the button width
                l.setProgress(0.3);
                setTimeout(function () {
                    l.setProgress(0.6);
                }, 2000);
                // do the backup through ajax
                $.ajax({
                    url: create_backup_url,
                    data: {_token: '{{csrf_token()}}'},
                    type: 'POST',
                    success: function (result) {
                        l.setProgress(0.9);
                        // Show an alert with the result
                        if (result.indexOf('failed') >= 0) {
                            toastr.warning('Seu backup NÃO pode ter sido criado. Verifique os arquivos de log para obter detalhes.', '', {timeOut: 6000});
                        } else {
                            toastr.success('Recarregando a página em 3 segundos.', '', {timeOut: 5000});
                        }
                        // Stop loading
                        l.setProgress(1);
                        l.stop();
                        // refresh the page to show the new file
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function (result) {
                        l.setProgress(0.9);
                        // Show an alert with the result
                        toastr.warning('O arquivo de backup NÃO pôde ser criado.', '', {timeOut: 5000});
                        // Stop loading
                        l.stop();
                    }
                });
            });

            // capture the Create db backup button
            $("#create-db-backup-button").click(function (e) {
                e.preventDefault();
                let create_backup_url = $(this).attr('href');
                // Create a new instance of ladda for the specified button
                let l = Ladda.create(document.querySelector('#create-db-backup-button'));
                // Start loading
                l.start();
                // Will display a progress bar for 10% of the button width
                l.setProgress(0.3);
                setTimeout(function () {
                    l.setProgress(0.6);
                }, 2000);
                // do the backup through ajax
                $.ajax({
                    url: create_backup_url,
                    data: {_token: '{{csrf_token()}}'},
                    type: 'POST',
                    success: function (result) {
                        l.setProgress(0.9);
                        // Show an alert with the result
                        if (result.indexOf('failed') >= 0) {
                            toastr.warning('Seu backup NÃO pode ter sido criado. Verifique os arquivos de log para obter detalhes.', '', {timeOut: 6000});
                        } else {
                            toastr.success('Recarregando a página em 3 segundos.', '', {timeOut: 5000});
                        }
                        // Stop loading
                        l.setProgress(1);
                        l.stop();
                        // refresh the page to show the new file
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function (result) {
                        l.setProgress(0.9);
                        // Show an alert with the result
                        toastr.warning('O arquivo de backup NÃO pôde ser criado.', '', {timeOut: 5000});
                        // Stop loading
                        l.stop();
                    }
                });
            });

            // capture the delete button
            $("[data-button-type=delete]").click(function (e) {
                e.preventDefault();
                let delete_button = $(this);
                let delete_url = $(this).attr('href');
                let disk = $(this).attr('data-disk');
                let file = $(this).attr('data-file');
                if (confirm("Tem certeza de que deseja excluir este arquivo de backup?") == true) {
                    $.ajax({
                        url: delete_url,
                        data: {_token: '{{ csrf_token() }}', disk: disk, file_name: file},
                        type: 'POST',
                        success: function (result) {
                            // Show an alert with the result
                            toastr.success('O arquivo de backup foi excluído.', '', {timeOut: 5000});
                            // delete the row from the table
                            delete_button.parentsUntil('tr').parent().remove();
                        },
                        error: function (result) {
                            // Show an alert with the result
                            toastr.warning('Erro.', '', {timeOut: 5000});
                        }
                    });
                } else {
                    toastr.info('O arquivo de backup NÃO foi excluído.', '', {timeOut: 5000});
                }
            });
        });
    </script>
@endsection
