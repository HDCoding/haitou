@extends('layouts.dashboard')

@section('subtitle', 'Notificações')

@section('content')

    <div class="font-weight-bold py-3 h4">Notificações</div>

    <hr class="border-light container-m--x mt-0 mb-4">

    <!-- Options -->
    <div class="text-center mb-4">
        <a href="{{ route('notifications.updateall') }}">
            <button type="button" class="btn btn btn-success" data-toggle="tooltip" data-original-title="Marcar tudo como lido">
                <i class="fa fa-eye"></i> Marcar tudo como lido
            </button>
        </a>
        <a href="{{ route('notifications.destroyall') }}">
            <button type="button" class="btn btn btn-danger" data-toggle="tooltip" data-original-title="Excluir todas as notificações">
                <i class="fa fa-times"></i> Excluir todas as notificações
            </button>
        </a>
    </div>
    <!-- / Options -->

    @includeIf('errors.errors', [$errors])
    @include('includes.messages')
    <!-- Notifications -->
    <div class="card mb-4">
        <h6 class="card-header">Notificações</h6>
        <div class="card-body">
            @forelse($notifications as $notification)
                <div class="media pb-1 mb-4">
                    <!-- Icone -->
                    <div class="ui-icon ui-icon-sm {{ $notification->data['icon'] }} border-0 text-white"></div>
                    <!-- End Icone -->
                    <div class="media-body ml-3">
                        <a href="{{ route('notifications.show', ['id' => $notification->id]) }}">
                            {{ $notification->data['title'] }}
                        </a>
                        <p class="my-1 text-dark {{ !empty($notification->read_at) ?: 'bg-lighter' }}">
                            {{ $notification->data['body'] }}
                        </p>
                        <div class="clearfix">
                            <a href="{{ route('notifications.destroy', ['id' => $notification->id]) }}" class="float-right text-danger" data-toggle="tooltip" data-original-title="Excluir notificação">
                                <span class="ion ion-md-trash mr-2"></span>
                            </a>
                            <a href="{{ route('notifications.update', ['id' => $notification->id]) }}" class="float-right text-info" data-toggle="tooltip" data-original-title="Marcar como lido">
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
        <div class="card-footer d-block text-center text-body small font-weight-semibold">
            Notificações
        </div>
    </div>
    <!-- / Notifications -->

@endsection
