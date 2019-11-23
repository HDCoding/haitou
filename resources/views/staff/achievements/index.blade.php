@extends('layouts.dashboard')

@section('subsubtitle', 'Conquistas')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.achievements')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header">Conquistas</div>
        <table class="table card-table">
            <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Troféu</th>
                <th>Descrição</th>
            </tr>
            </thead>
            <tbody>
            @foreach($achievements as $achievement)
                <tr>
                    <th scope="row">{{ $achievement->id }}</th>
                    <td>
                        <img
                            src="{{ asset('images/achievements/' . strtolower(str_replace(' ', '', $achievement->name) . '.png')) }}"
                            data-toggle="tooltip"
                            data-original-title="{{ $achievement->name }}"
                            alt="{{ $achievement->name }}" width="40px">
                    </td>
                    <td>{{ $achievement->description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
