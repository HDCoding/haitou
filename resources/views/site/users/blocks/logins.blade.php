<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Browser</th>
            <th>System</th>
            <th>Mobile</th>
            <th>Tablet</th>
            <th>Desktop</th>
            <th>Data</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logins as $login)
            <tr>
                <th>{{ $login->id }}</th>
                <td>{{ $login->user_agent }}</td>
                <td>{{ $login->system }}</td>
                <td>{{ $login->is_mobile ? 'Sim' : 'Nao'}}</td>
                <td>{{ $login->is_tablet ? 'Sim' : 'Nao'}}</td>
                <td>{{ $login->is_desktop ? 'Sim' : 'Nao' }}</td>
                <td>{{ format_date_time($login->created_at) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
