@extends('layouts.dashboard')

@section('title', 'Regras')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Regras</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Regras</h4>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($rules as $key => $rule)
                            <li class="nav-item">
                                <a class="nav-link {{ $key == 0 ? 'active' : ''}}" data-toggle="tab" href="#tab-{{ $rule->id }}" role="tab">
                                    <span class="hidden-sm-up">
                                        <i class="{{ $rule->icon }}"></i>
                                    </span>
                                    <span class="hidden-xs-down">{{ $rule->name }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border m-t-20">
                            @foreach($rules as $key => $rule)
                            <div class="tab-pane {{ $key == 0 ? 'active' : ''}}" id="tab-{{ $rule->id }}" role="tabpanel">
                                @if($rule->id == $rule->id)
                                    {!! $rule->descriptionHtml() !!}
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
