@section('css')
    <!-- DatePicker -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

<div class="form-group">
    {!! Form::label('name', 'Nome: *', ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('image', 'Imagem:', ['class' => 'form-label']) !!}
    {!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('website', 'Web Site:', ['class' => 'form-label']) !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('dob', 'Data de Nascimento:', ['class' => 'form-label']) !!}
    {!! Form::text('dob', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Descrição: *', ['class' => 'form-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
</div>

{!! Form::submit($submitButton, ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}

@section('script')
    <!-- DatePicker -->
    <script src="{{ asset('vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>

    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $('#dob').datepicker({
                format: 'yyyy-mm-dd',
                language: 'pt-BR',
                autoclose: true
            });

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
