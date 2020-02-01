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
                    <a href="{{ route('notifications.updateall') }}" class="btn btn-sm btn-success btn-rounded">
                        <i class="fa fa-eye"></i> Marcar tudo como lido
                    </a>
                    <a href="{{ route('notifications.destroyall') }}" class="btn btn-sm btn-danger btn-rounded">
                        <i class="fa fa-times"></i> Excluir todas as notificações
                    </a>
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
                        @forelse($notifications as $notification)
                            <div class="media pb-1 mb-4">
                                <!-- Icone -->
                                <div class="ui-icon {{ $notification->data['icon'] }} border-0 text-dark"></div>
                                <!-- End Icone -->
                                <div class="media-body ml-3">
                                    <a href="{{ route('notifications.show', ['id' => $notification->id]) }}">
                                        {{ $notification->data['title'] }}
                                    </a>
                                    <p class="my-1 text-dark {{ !empty($notification->read_at) ?: 'bg-light' }}">
                                        {{ $notification->data['body'] }}
                                    </p>
                                    <div class="clearfix">
                                        <a class="float-right text-danger" href="{{ route('notifications.destroy', ['id' => $notification->id]) }}" data-toggle="tooltip" data-original-title="Excluir notificação">
                                            <span class="ion ion-md-trash mr-2"></span>
                                        </a>
                                        <a class="float-right text-info" href="{{ route('notifications.update', ['id' => $notification->id]) }}" data-toggle="tooltip" data-original-title="Marcar como lido">
                                            <span class="ion ion-md-archive mr-4"></span>
                                        </a>
                                        <span class="float-left text-muted small">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="d-block text-center p-2 my-1">Sem notificações no momento.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
