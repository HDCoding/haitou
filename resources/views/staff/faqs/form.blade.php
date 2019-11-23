@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

<div class="form-group">
    {!! Form::label('question', 'Pergunta:') !!}
    {!! Form::text('question', null, ['class' => 'form-control', 'maxlength' => 250]) !!}
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categoria:') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('answer', 'Resposta:') !!}
    {!! Form::textarea('answer', null, ['class' => 'form-control', 'rows' => 8]) !!}
</div>

{!! Form::submit($submitButton, ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
<br>

@section('script')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            var textarea = document.getElementById('answer');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
