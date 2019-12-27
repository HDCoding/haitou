@section('css')
    <!-- sceditor -->
    <link href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
@endsection

<div class="form-group">
    {!! Form::label('name', 'Nome: *') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome']) !!}
</div>

<div class="form-group">
    {!! Form::label('logo', 'Logo: *') !!}
    {!! Form::text('logo', null, ['class' => 'form-control', 'placeholder' => 'Logo']) !!}
</div>

<div class="form-group">
    {!! Form::label('website', 'Web Site: (Opcional)') !!}
    {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Web Site']) !!}
</div>

<div class="form-group">
    {!! Form::label('discord', 'Discord: (Opcional)') !!}
    {!! Form::text('discord', null, ['class' => 'form-control', 'placeholder' => 'Discord']) !!}
</div>

<div class="form-group">
    {!! Form::label('is_active', 'Ativo?:') !!}
    {!! Form::select('is_active', [1 => 'Sim', 0 => 'Não'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submitButton, ['class' => 'btn btn-primary btn-rounded']) !!}
<br>

@section('scripts')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- sceditor -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
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
