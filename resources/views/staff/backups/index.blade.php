@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.backups'))

@section('css')
    @include('includes.datatables.css')
    <link rel="stylesheet" href="{{ asset('vendor/ladda/ladda.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.backups')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <button id="create-full-backup-button" href="{{ url('staff/backup/create-full') }}" class="btn btn-primary ladda-button" data-style="zoom-in">
                    <span class="ladda-label"><i class="fa fa-plus"></i> Create Full Backup</span>
                </button>
                <button id="create-files-backup-button" href="{{ url('staff/backup/create-files') }}" class="btn btn-primary ladda-button" data-style="zoom-in">
                    <span class="ladda-label"><i class="fa fa-plus"></i> Create Files Backup</span>
                </button>
                <button id="create-db-backup-button" href="{{ url('staff/backup/create-db') }}" class="btn btn-primary ladda-button" data-style="zoom-in">
                    <span class="ladda-label"><i class="fa fa-plus"></i> Create Database Backup</span>
                </button>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>File size</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($backups as $key => $backup)
                    <tr class="odd gradeX">
                        <td class="text-center">
                            {{ ++$key }}
                        </td>
                        <td class="">{{ $backup['disk'] }}</td>
                        <td>
                            {{ \Carbon\Carbon::createFromTimeStamp($backup['last_modified'])->formatLocalized('%d %B %Y, %H:%M') }}
                        </td>
                        <td>
                            {{ make_size($backup['file_size']) }}
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                @if($backup['download'])
                                    <a href="{{ url('staff/backup/download') }}?disk={{ $backup['disk'] }}&path={{ urlencode($backup['file_size']) }}&file_name={{ urlencode($backup['file_name']) }}"
                                       data-toggle="tooltip" title="Download">
                                        <button type="button" class="btn btn-xs btn-outline-primary">
                                            <span class="fas fa-cloud-download-alt"></span> Download
                                        </button>
                                    </a>
                                @endif
                                <a data-disk="{{ $backup['disk'] }}" data-file="{{ $backup['file_name'] }}" data-button-type="delete"
                                   href="{{ url('staff/backup/delete') }}" data-toggle="tooltip" title="Delete">
                                    <button type="button" class="btn btn-xs btn-outline-danger">
                                        <span class="fas fa-trash"></span> Delete
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

@endsection

@section('script')
    @include('includes.datatables.js', ['perPage' => 50, 'order' => false])

    <script src="{{ asset('vendor/spin/spin.js') }}"></script>
    <script src="{{ asset('vendor/ladda/ladda.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        jQuery(document).ready(function ($) {
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
                            toastr.warning('Your backup may NOT have been created. Please check log files for details.', '', {timeOut: 3000});
                        } else {
                            toastr.success('Reloading the page in 3 seconds.', '', {timeOut: 3000});
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
                        toastr.warning('The backup file could NOT be created.', '', {timeOut: 3000});
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
                            toastr.warning('Your backup may NOT have been created. Please check log files for details.', '', {timeOut: 3000});
                        } else {
                            toastr.success('Reloading the page in 3 seconds.', '', {timeOut: 3000});
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
                        toastr.warning('The backup file could NOT be created.', '', {timeOut: 3000});
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
                            toastr.warning('Your backup may NOT have been created. Please check log files for details.', '', {timeOut: 3000});
                        } else {
                            toastr.success('Reloading the page in 3 seconds.', '', {timeOut: 3000});
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
                        toastr.warning('The backup file could NOT be created.', '', {timeOut: 3000});
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
                if (confirm("Are your sure you want to delete this backup file?") == true) {
                    $.ajax({
                        url: delete_url,
                        data: {_token: '{{csrf_token()}}', disk: disk, file_name: file},
                        type: 'POST',
                        success: function (result) {
                            // Show an alert with the result
                            toastr.success('The backup file was deleted.', '', {timeOut: 3000});
                            // delete the row from the table
                            delete_button.parentsUntil('tr').parent().remove();
                        },
                        error: function (result) {
                            // Show an alert with the result
                            toastr.warning('Error.', '', {timeOut: 3000});
                        }
                    });
                } else {
                    toastr.info('The backup file has NOT been deleted.', '', {timeOut: 3000});
                }
            });
        });
    </script>
@endsection
