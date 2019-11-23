@extends('layouts.dashboard')

@section('subtitle', 'Pesquisas')

@section('content')

    <div class="py-1 mb-2">
        {!! Form::open(['url' => 'search']) !!}
        <div class="input-group">
            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquisar...', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary"><i class="ion ion-ios-search"></i>&nbsp; Pesquisar</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <ul class="search-nav nav nav-tabs tabs-alt container-m-nx container-p-x mb-4">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#search-members"><i class="ion ion-ios-people"></i>&nbsp; Membros</a>
        </li>
    </ul>

    <div class="tab-content">

        <!-- Members -->
        <div class="tab-pane fade show active" id="search-members">
            <div class="row">

                @forelse($users as $user)
                <div class="col-md-6 col-xl-4">
                    <div class="card card-condenced mb-4">
                        <div class="card-body media align-items-center">
                            <img src="{{ $user->getAvatar() }}" alt="" class="ui-w-40 rounded-circle">
                            <div class="media-body ml-3">
                                <a href="{{ route('user.profile', ['slug' => $user->slug]) }}" target="_blank" class="text-body font-weight-semibold mb-2">{{ $user->name }}</a>
                                <div class="text-muted small">{{ '@'.$user->slug }}</div>
                            </div>
{{--                                <a href="javascript:void(0)" class="btn btn-outline-primary rounded-pill btn-sm md-btn-flat d-block">Follow</a>--}}
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12 card py-4">
                    <p class="text-big text-center">Nenhum Membro encontrado.</p>
                </div>
                @endforelse

            </div>

            <div class="d-flex mt-5">
                <div class="mx-auto">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
        <!-- /Members -->

    </div>

@endsection
