@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

{!! Form::hidden('user_id', $user->id) !!}
<div class="form-group">
    {!! Form::label('title', 'Título: *') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required', 'maxlength' => 100]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição: *') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8, 'required']) !!}
</div>

<br>
{!! Form::submit($submitButton, ['class' => 'btn btn-success btn-rounded btn-outline']) !!}

@section('script')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>
    <!-- Page JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            //terms
            var textarea = document.getElementById('description');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
