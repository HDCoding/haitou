@extends('layouts.dashboard')

@section('title', 'Notificações')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notificações</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Options -->
        <div class="row">
            <div class="col-md-12 mt-3 mb-3">
                <div class="float-left">
                    {!! Form::open(['route' => 'notifications.read.all']) !!}
                    <button type="submit" class="btn btn-sm btn-success btn-rounded">
                        <i class="fa fa-eye"></i> Marcar tudo como lido
                    </button>
                    {!! Form::close() !!}
                </div>
                <div class="float-right">
                    {!! Form::open(['route' => 'notifications.destroy.all', 'method' => 'DELETE']) !!}
                    <button type="submit" class="btn btn-sm btn-danger btn-rounded">
                        <i class="fa fa-times"></i> Excluir todas as notificações
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- / Options -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <div class="table-responsive m-t-5">
                            <table class="table">
                                <tbody>
                                @forelse($notifications as $notification)
                                    <tr class="{{ empty($notification->read_at) ? 'bg-light' : '' }}">
                                        <th class="align-middle">
                                            <i class="{{ $notification->data['icon'] }} fa-2x"></i>
                                        </th>
                                        <td>
                                            <a href="{{ route('notifications.show', ['id' => $notification->id]) }}">
                                                {{ $notification->data['title'] }}
                                            </a>
                                            <p class="my-1 text-dark">
                                                {{ $notification->data['body'] }}
                                            </p>
                                            <span class="float-left text-muted small">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group text-center">
                                                {!! Form::open(['route' => ['notifications.update', 'id' => $notification->id]]) !!}
                                                <button type="submit" class="btn btn-sm btn-info btn-rounded mr-2"
                                                        data-toggle="tooltip" data-original-title="Marcar como lido">
                                                    <i class="ion ion-md-archive"></i> Lido
                                                </button>
                                                {!! Form::close() !!}

                                                {!! Form::open(['route' => ['notifications.destroy', 'id' => $notification->id], 'method' => 'DELETE']) !!}
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger btn-rounded float-right"
                                                        data-toggle="tooltip" data-original-title="Excluir notificação">
                                                    <i class="ion ion-md-trash"></i> Excluir
                                                </button>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="3" class="d-block text-center p-2 my-1 m-t-10">
                                            <p>Sem notificações no momento.</p>
                                        </th>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
