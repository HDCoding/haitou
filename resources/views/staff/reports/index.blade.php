@extends('layouts.dashboard')

@section('title', trans('dashboard.reports'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.reports')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('dashboard.reports')</h4>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Assunto</th>
                                    <th>Tipo</th>
                                    <th>Resolvido</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($reports as $report)
                                    <tr>
                                        <td class="text-center">{{ $report->id }}</td>
                                        <td>{{ link_to_route('reports.show', $report->name, ['id' => $report->id]) }}</td>
                                        <td>{!! $report->type() !!}</td>
                                        <td class="hidden-xs">{!! $report->solved() !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhum registro no momento.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
