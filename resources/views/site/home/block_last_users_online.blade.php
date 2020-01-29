<div class="card">
    <div class="card-header bg-dark">
        <h5 class="text-white"><i class="fa fa-users"></i> Usuários Online
            <span class="label label-primary font-weight-bold">{{ $users->count() }}</span>
        </h5>
    </div>
    <div class="card-body">
        @foreach ($users as $user)
            @if ($user->show_profile == false)
                <span class="badge text-orange font-weight-bold" style="margin-bottom: 10px;">
                    <i class="fa fa-user-ninja"></i> Escondido
                    @if (auth()->user()->can('usuarios-mod'))
                        <a href="{{ route('user.profile', ['slug' => $user->slug]) }}"> {{ $user->username }}
                            @if ($user->is_warned == true)
                                <i class="fa fa-exclamation-circle text-orange" aria-hidden="true" data-toggle="tooltip" data-original-title="Aviso ativo"></i>
                            @endif
                        </a>
                    @endif
                </span>
            @else
                <a href="{{ route('user.profile', ['slug' => $user->slug]) }}">
                    <span class="badge font-weight-bold" style="color:{{ $user->group->color }}; margin-bottom: 10px;">
                        <i class="{{ $user->group->icon }}" data-toggle="tooltip" data-original-title="{{ $user->group->name }}"></i>
                        {{ $user->username }}
                        @if ($user->is_warned == true)
                            <i class="fa fa-exclamation-circle text-orange" aria-hidden="true" data-toggle="tooltip" data-original-title="Aviso ativo"></i>
                        @endif
                    </span>
                </a>
            @endif
        @endforeach
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <span class="badge badge-pill badge-light text-orange font-weight-bold mr-2">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i> Escondido
                    </span>
                    @foreach ($groups as $group)
                        <span class="badge badge-pill badge-light font-weight-bold mr-2" style="color:{{ $group->color }};">
                            <i class="{{ $group->icon }}" aria-hidden="true"></i> {{ $group->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
