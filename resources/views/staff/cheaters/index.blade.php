@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.cheaters'))

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.cheaters')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-lg-5">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                Possíveis Cheaters (Fantasmas)
            </div>
        </div>
        <table class="table card-table">
            <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Grupo</th>
                    <th>Registro</th>
                    <th>Ultimo login</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cheaters as $cheater)
                <tr>
                    <td>{{ link_to_route('user.profile', $cheater->user->name, ['slug' => $cheater->user->slug]) }}</td>
                    <td>{{ $cheater->user->role->name }}</td>
                    <td>{{ $cheater->user->created_at->toDayDateTimeString() }}</td>
                    @if($cheater->user->logins->created_at != null)
                        <td>{{ $cheater->user->logins->created_at->toDayDateTimeString() }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $cheaters->links() }}
    </div>

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                Programas nao autorizados
            </div>
        </div>
        <table class="table card-table">
            <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Grupo</th>
                    <th>Porta</th>
                    <th>IP</th>
                    <th>Programa</th>
                    <th>Registro</th>
                    <th>Ultimo login</th>
                </tr>
            </thead>
            <tbody>
            @foreach($programs as $program)
                <tr>
                    <td>{{ link_to_route('user.profile', $program->user->name, ['slug' => $program->user->slug]) }}</td>
                    <td>{{ $program->user->role->name }}</td>
                    <td>{{ $program->port }}</td>
                    <td>{{ $program->ip }}</td>
                    <td>{{ $program->program }}</td>
                    <td>{{ $program->user->created_at->toDayDateTimeString() }}</td>
                    @if(isset($program->user->logins->created_at))
                        <td>{{ $program->user->logins->created_at->toDayDateTimeString() }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $programs->links() }}
    </div>

@endsection
