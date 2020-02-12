<div class="card">
    <div class="card-header bg-danger">
        <h5 class="text-white"><i class="fa fa-question"></i> Últimas Pesquisas
            <a class="text-white float-right" data-action="collapse"><i class="ti-minus"></i></a>
        </h5>
    </div>
    <div class="card-body collapse show">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="border-top-0">Pergunta</th>
                <th class="border-top-0">Votos</th>
            </tr>
            </thead>
            <tbody>
            @foreach($polls as $poll)
                <tr>
                    <td>{{ link_to_route('site.poll.show', $poll->name, ['id' => $poll->id, 'slug' => $poll->slug]) }}</td>
                    <td>{{ $poll->totalVotes() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
