@extends('layouts.dashboard')

@section('subtitle', 'Conquistas')

@section('content')

    <h4 class="font-weight-bold py-3 mb-2">Conquistas</h4>

    <div class="card">
        <div class="card-header bg-light text-center">
            <b class="card-header-title mr-2">Conquistas desbloqueadas: {{ $unlocked }} </b>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Troféu</th>
                            <th>Descrição</th>
                            <th class="text-center">Progresso</th>
                        </tr>
                    </thead>
                    @foreach($achievements as $achievement)
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{ asset('images/achievements/' . strtolower(str_replace(' ', '', $achievement->details->name) . '.png')) }}"
                                     data-toggle="tooltip"
                                     data-original-title="{{ $achievement->details->name }}"
                                     alt="{{ $achievement->details->name }}" width="40px">
                            </td>
                            <td>{{ $achievement->details->description }}</td>
                            @if($achievement->isUnlocked())
                                <td class="text-center">
                                    <span class="badge badge-pill badge-success">Desbloqueado</span>
                                </td>
                            @else
                                <td class="text-center">
                                    <span class="badge badge-pill badge-warning"> Progresso:
                                    {{ $achievement->points }} / {{ $achievement->details->points }}
                                    </span>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>

        </div>
    </div>

@endsection
