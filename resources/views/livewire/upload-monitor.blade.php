<div wire:poll.5s>
    <h1>Video Upload Monitor</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Job</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Started At</th>
                <th>Finished At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->name }}</td>
                <td>{{ $job->status }}</td>
                <td>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $job->progress }}%;" aria-valuenow="{{ $job->progress }}" aria-valuemin="0" aria-valuemax="100">{{ $job->progress }}%</div>
                    </div>
                </td>
                <td>{{ $job->started_at }}</td>
                <td>{{ $job->finished_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $jobs->links() }}
</div>