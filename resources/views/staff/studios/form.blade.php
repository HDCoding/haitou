@section('css')
    <!-- sceditor -->
    <link href="{{ secure_asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet" />
@endsection

<div class="form-group">
    {!! Form::label('name', 'Nome *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('logo', 'Logo') !!}
    {!! Form::text('logo', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('website', 'Website') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Descrição') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control note', 'rows' => 8]) !!}
</div>
{!! Form::submit($submitButton, ['class' => 'btn btn-primary btn-rounded']) !!}

@section('scripts')
    <!-- sceditor -->
    <script src="{{ secure_asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ secure_asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- sceditor -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
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
