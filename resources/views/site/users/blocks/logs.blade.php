<div class="table-responsive">
    <table class="table table-striped">
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
        @foreach($logs as $log)
            <tr>
                <th>{{ $log->id }}</th>
                <td>{{ $log->user_agent }}</td>
                <td>{{ $log->system }}</td>
                <td>{{ $log->is_mobile ? 'Sim' : 'Nao'}}</td>
                <td>{{ $log->is_tablet ? 'Sim' : 'Nao'}}</td>
                <td>{{ $log->is_desktop ? 'Sim' : 'Nao' }}</td>
                <td>{{ format_date_time($log->created_at) }}</td>
            </tr>
            <tr>
                <td colspan="7" class="some-padding button-padding">
                    <div class="topic-posts button-padding">
                        <div class="log" id="log-{{ $log->id }}">
                            {{ $log->content }}
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
