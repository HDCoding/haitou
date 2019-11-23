@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.reports'))

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.reports')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <div class="card-datatable table-responsive">
            <table class="table table-striped table-bordered">
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
                        <td>{!! $report->getType() !!}</td>
                        <td class="hidden-xs">{!! $report->getSolved() !!}</td>
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

@endsection
