@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.failedlogins'))

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.failedlogins')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header">@lang('dashboard.failedlogins')</div>
        <table class="table card-table">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>E-mail</th>
                    <th>IP</th>
                    <th>Browser</th>
                    <th>System</th>
                    <th>Mobile</th>
                    <th>Tablet</th>
                    <th>Desktop</th>
                </tr>
            </thead>
            <tbody>
            @foreach($attempts as $attempt)
                <tr>
                    <th scope="row">{{ $attempt->id }}</th>
                    <td>{{ !empty($attempt->user_id) ? $attempt->user->name : ''}}</td>
                    <td>{{ !empty($attempt->email) ? $attempt->email : '' }}</td>
                    <td>{{ $attempt->ip }}</td>
                    <td>{{ $attempt->user_agent }}</td>
                    <td>{{ $attempt->system }}</td>
                    <td>{{ $attempt->is_mobile ? 'Sim' : 'Nao'}}</td>
                    <td>{{ $attempt->is_tablet ? 'Sim' : 'Nao'}}</td>
                    <td>{{ $attempt->is_desktop ? 'Sim' : 'Nao' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
