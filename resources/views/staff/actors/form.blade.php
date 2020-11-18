@section('css')
    <!-- DatePicker -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

<div class="form-group">
    {!! Form::label('name', 'Nome: *', ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('imagem', 'Imagem:', ['class' => 'form-label']) !!}
    {!! Form::file('image', ['accept' => 'image/*']) !!}
</div>
<div class="form-group">
    {!! Form::label('website', 'Web Site:', ['class' => 'form-label']) !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('birthday', 'Data de Nascimento:', ['class' => 'form-label']) !!}
    {!! Form::text('birthday', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Descrição: *', ['class' => 'form-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
</div>

{!! Form::submit($submitButton, ['class' => 'btn btn-primary btn-rounded']) !!}

@section('scripts')
    <!-- datepicker -->
    <script src="{{ secure_asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>

    <!-- sceditor -->
    <script src="{{ secure_asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ secure_asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $('#birthday').datepicker({
                format: 'yyyy-mm-dd',
                language: 'pt-BR',
                autoclose: true
            });

            let textarea = document.getElementById('description');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
