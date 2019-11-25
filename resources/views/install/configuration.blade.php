@extends('install.layout')

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger fade in alert-dismissable">
            {{ session('error') }}
        </div>
    @endif

    <h2>2. Configuration</h2>

    <form method="POST" action="{{ url('install/configuration') }}" class="form-horizontal">
        {{ csrf_field() }}

        <div class="box">
            <p>Please enter your database connection details.</p>

            <div class="configure-form">
                <div class="form-group {{ $errors->has('db.host') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="host">Host <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="text" name="db[host]" value="{{ old('db.host', '127.0.0.1') }}" id="host" class="form-control" autofocus>

                        {!! $errors->first('db.host', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('db.port') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="port">Port <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="text" name="db[port]" value="{{ old('db.port', '3306') }}" id="port" class="form-control">

                        {!! $errors->first('db.port', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('db.username') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="db-username">DB Username <span>*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="db[username]" value="{{ old('db.username') }}" id="db-username" class="form-control">

                        {!! $errors->first('db.username', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="db-password">DB Password</label>

                    <div class="col-sm-9">
                        <input type="password" name="db[password]" value="{{ old('db.password') }}" id="db-password" class="form-control">
                    </div>
                </div>

                <div class="form-group {{ $errors->has('db.database') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="database">Database <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="text" name="db[database]" value="{{ old('db.database') }}" id="database" class="form-control">

                        {!! $errors->first('db.database', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="box">
            <p>Please enter a username and password for the administration.</p>

            <div class="configure-form">
                <div class="form-group {{ $errors->has('admin.first_name') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="admin-first-name">First Name <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="text" name="admin[first_name]" value="{{ old('admin.first_name') }}" id="admin-first-name" class="form-control">

                        {!! $errors->first('admin.first_name', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('admin.last_name') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="admin-last-name">Last Name <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="text" name="admin[last_name]" value="{{ old('admin.last_name') }}" id="admin-last-name" class="form-control">

                        {!! $errors->first('admin.last_name', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('admin.email') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="admin-email">Email <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="text" name="admin[email]" value="{{ old('admin.email') }}" id="admin-email" class="form-control">

                        {!! $errors->first('admin.email', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('admin.password') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="admin-password">Password <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="password" name="admin[password]" id="admin-password" class="form-control">

                        {!! $errors->first('admin.password', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="admin-confirm-password">Confirm Password <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="password" name="admin[password_confirmation]" id="admin-confirm-password" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="box">
            <p>Please enter your store details.</p>

            <div class="configure-form p-b-0">
                <div class="form-group {{ $errors->has('store.store_name') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="store-name">Store Name <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="text" name="store[store_name]" value="{{ old('store.store_name') }}" id="store-name" class="form-control">

                        {!! $errors->first('store.store_name', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('store.store_email') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="store-email">Store Email <span>*</span></label>

                    <div class="col-sm-9">
                        <input type="text" name="store[store_email]" value="{{ old('store.store_email') }}" id="store-email" class="form-control">

                        {!! $errors->first('store.store_email', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('store.search_engine') ? 'has-error': '' }}">
                    <label class="control-label col-sm-3" for="store-search-engine">Search Engine <span>*</span></label>

                    <div class="col-sm-9">
                        <select name="store[search_engine]" class="form-control custom-select-black" id="store-search-engine">
                            <option value="mysql" {{ old('store.search_engine') === 'mysql' ? 'selected' : '' }}>
                                MySQL
                            </option>

                            <option value="algolia" {{ old('store.search_engine') === 'algolia' ? 'selected' : '' }}>
                                Algolia
                            </option>
                        </select>

                        @if ($errors->has('store.search_engine'))
                            {!! $errors->first('store.search_engine', '<span class="help-block">:message</span>') !!}
                        @else
                            <span class="help-block">You cannot change the search engine later.</span>
                        @endif
                    </div>
                </div>

                <div class="{{ old('store.search_engine') === 'algolia' ? '' : 'hide' }}" id="algolia-fields">
                    <div class="form-group {{ $errors->has('store.algolia_app_id') ? 'has-error': '' }}">
                        <label class="control-label col-sm-3" for="store-algolia-app-id">Algolia Application ID <span>*</span></label>

                        <div class="col-sm-9">
                            <input type="text" name="store[algolia_app_id]" value="{{ old('store.algolia_app_id') }}" id="store-algolia-app-id" class="form-control">

                            {!! $errors->first('store.algolia_app_id', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('store.algolia_secret') ? 'has-error': '' }}">
                        <label class="control-label col-sm-3" for="store-algolia-secret">Algolia Admin API Key <span>*</span></label>

                        <div class="col-sm-9">
                            <input type="password" name="store[algolia_secret]" value="{{ old('store.algolia_secret') }}" id="store-algolia-secret" class="form-control">

                            {!! $errors->first('store.algolia_secret', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-buttons clearfix">
            <button type="submit" class="btn btn-primary pull-right install-button">Install</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $('#store-search-engine').on('change', function () {
            $('#algolia-fields').toggleClass('hide');
        });

        $('.install-button').on('click', function (e) {
            var button = $(e.currentTarget);

            button.data('loading-text', button.html())
                .addClass('btn-loading')
                .button('loading');
        });
    </script>
@endpush
