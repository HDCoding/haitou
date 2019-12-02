<!-- dataTables JS -->
<script src="{{ asset('vendor/datatables/datatables.js') }}"></script>

<script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
    $(document).ready( function () {
        $('.data-table').DataTable({
            "displayLength": {{ $perPage }},
            "searching": true,
            "responsive": true,
            @if($order)
            "order": [[ 0, "desc" ]],
            @endif
            // "language": {
            //     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            // }
        });
    });
</script>
