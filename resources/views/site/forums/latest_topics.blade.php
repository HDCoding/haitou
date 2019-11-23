@extends('layouts.dashboard')

@section('subtitle', 'Forum')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 mb-4">
        <ol class="breadcrumb font-weight-bold mb-3 h4">
            <li class="breadcrumb-item">
                <a href="{{ url('forum') }}"><i class="ion ion-ios-chatbubbles"></i> Fórum</a>
            </li>
            <li class="breadcrumb-item active">
                Tópicos mais recentes
            </li>
        </ol>
        <div class="col-12 col-md-3 p-0 mb-3">
            {!! Form::open(['route' => 'forum.search', 'method' => 'GET']) !!}
            {!! Form::hidden('sorting', 'created_at') !!}
            {!! Form::hidden('direction', 'desc') !!}
            {!! Form::text('name', (isset($params) && is_array($params) && array_key_exists('name', $params) ? $params['name'] : ''), ['class' => 'form-control', 'placeholder' => 'Pesquisar...', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
            {!! Form::close() !!}
        </div>
    </div>

    @includeIf('errors.errors', [$errors])

    @include('site.forums.buttons')

    <div class="card">
        <div class="card-header">Tópicos mais recentes</div>
        <table class="table card-table">
            <thead class="thead-light">
                <tr>
                    <th>Fórum</th>
                    <th>Tópico</th>
                    <th>Autor</th>
                    <th>Estatísticas</th>
                    <th>Última Informação</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <th>
                        <span class="badge badge-extra text-bold">{{ $result->forum->name }}</span>
                    </th>
                    <td>
                        <a href="{{ route('forum_topic', ['id' => $result->id, 'slug' => $result->slug]) }}">{{ $result->name }}</a>
                        @if ($result->topic->is_closed == true)
                            <span class="badge badge-default">Fechadas</span>
                        @endif
                        @if ($result->topic->is_pinned == true)
                            <span class="badge badge-success">Pin</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user.profile', ['slug' => Str::slug($result->first_post_user_name)]) }}">
                            {{ $result->first_post_user_name }}
                        </a>
                    </td>
                    <td>
                        {{ $result->num_post - 1 }} Respostas / {{ $result->views }} Views
                    </td>
                    <td>
                        <a href="{{ route('user.profile', ['slug' => Str::slug($result->last_post_user_name)]) }}">
                            {{ $result->last_post_user_name }}
                        </a>,
                        @if($result->updated_at && $result->updated_at != null)
                            <time datetime="{{ date('d-m-Y h:m', strtotime($result->updated_at)) }}">
                                {{ date('M d Y', strtotime($result->updated_at)) }}
                            </time>
                        @else
                            <time datetime="N/A">N/A</time>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex mt-5">
            <div class="mx-auto">
                {{ $results->links() }}
            </div>
        </div>

    </div>

@endsection
