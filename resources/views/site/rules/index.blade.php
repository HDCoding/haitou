@extends('layouts.dashboard')

@section('subtitle', 'Regras')

@section('content')

    <h3 class="text-center font-weight-bold py-3 mb-4">Regras</h3>

    <div class="nav-tabs-top nav-responsive-xl">
        <ul class="nav nav-tabs nav-fill">
            @foreach($rules as $key => $rule)
                <li class="nav-item">
                    <a class="nav-link {{ $key == 0 ? 'active' : ''}} show" data-toggle="tab" href="#tab-{{ $rule->id }}">
                        <i class="{{ $rule->icon }}"></i> {{ $rule->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach($rules as $key => $rule)
                <div class="tab-pane fade {{ $key == 0 ? 'active' : ''}} show" id="tab-{{ $rule->id }}">
                    <div class="card-body">
                        @if($rule->id == $rule->id)
                            {!! $rule->descriptionHtml() !!}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
