<x-detail-data :details="$data" :vertical="true" />
<x-form-label :label="__('Progress')" />
<table class="table">
    <thead>
        <tr>
            <th>Remark</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    @if ($task_dt->progress->isEmpty())
        <tr>
            <td colspan="3" class="text-center">Belum ada progress</td>
        </tr>
    @else
        @foreach ($task_dt->progress as $note)
            <tr>
                <td>{{ $note->note }}</td>
                <td>{{ $note->jumlah }}</td>
                <td>{!! statusTask($note->status) !!}</td>
                <td>{{ tanggal($note->created_at, 'd F Y H:i') }}</td>
            </tr>
        @endforeach
    @endif

</table>
