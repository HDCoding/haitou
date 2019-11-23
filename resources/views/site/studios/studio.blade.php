@extends('layouts.dashboard')

@section('subtitle', $studio->name)

@section('content')

    <div class="block">
        <div class="row">
            <div class="col-md-4">
                <!-- logo -->
                <div class="block block-rounded">
                    <img class="img-responsive" src="{{ $studio->logo }}" alt="Poster">
                </div>
                <!-- END logo -->

                <!-- Sobre -->
                <div class="block block-rounded">
                    <div class="block-header bg-gray-lighter text-center">
                        <h3 class="block-title">{{ $studio->name }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- description -->
                @includeIf('errors.errors', [$errors])
                <div class="block block-rounded">
                    <div class="block-content">
                        <table class="table table-striped table-borderless remove-margin-b">
                            <thead>
                                <tr>
                                    <th colspan="2">{{ $studio->name }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Nome:</td>
                                    <td>{{ $studio->name }}</td>
                                </tr>
                                <tr>
                                    <td>Website:</td>
                                    <td>{{ $studio->website }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Info:</b> {!! $studio->descriptionHtml() !!}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Comentários -->
                        <div class="block mt-5">
                            <div class="nav-tabs-top mb-4">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#nav-comments">
                                            <i class="fa fa-comment text-info"></i> Comentários
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="nav-comments">
                                        @include('layouts.includes.comment_layout')
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->permission->studios_comment)
                        <div class="card">
                            <div class="card-body">
                                {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
                                {!! Form::hidden('studio_id', $studio->id) !!}
                                <div class="form-group">
                                    {!! Form::label('content', 'Comentário: *') !!}
                                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5]) !!}
                                </div>
                                {!! Form::submit('Comentar', ['class' => 'btn btn-primary btn-outline-primary']) !!}
                                <br>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        @else
                            <p class="text-center font-weight-bold">Sua permissão de fazer comentários em estúdios foram revogadas!!</p>
                        @endif
                        <!-- / Comentários -->
                    </div>
                </div>
                <!-- END description -->
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });

        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];
                getData(page);
            });
        });

        function getData(page) {
            $.ajax({
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function (data) {
                $("#nav-comments").empty().html(data);
                location.hash = page;
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
    </script>

@endsection
