<x-detail-data :details="$detail" />
<x-form-label :label="__('Progress')" />
<table class="table">
    <thead>
        <tr>
            <th class="text-center" width="10%">Kode Produk</th>
            <th width="20%">Produk</th>
            <th class="text-center" width="10%">Jumlah</th>
            <th class="text-center" width="10%">Status</th>
            <th class="text-center">Progress</th>
        </tr>
    </thead>
    @if ($penugasan->task_dt->isEmpty())
        <tr>
            <td colspan="3" class="text-center">Belum ada penugasan detail</td>
        </tr>
    @else
        @foreach ($penugasan->task_dt as $task_dt)
            <tr>
                <td class="text-center" style="vertical-align: top">{{ $task_dt->produk->kode_produk }}</td>
                <td style="vertical-align: top">{{ $task_dt->produk->nama_produk }}</td>
                <td class="text-center" style="vertical-align: top">{{ $task_dt->jumlah }}</td>
                <td class="text-center" style="vertical-align: top">{!! statusTask($task_dt->status) !!}</td>
                <td>
                    @if ($task_dt->progress->isEmpty())
                        Belum ada progress
                    @else
                        <ul>
                            @foreach ($task_dt->progress as $progress)
                                <li>
                                    {{ TASK_STATUS[$progress->status] }} - {{ $progress->jumlah }} pcs
                                    <br />
                                    {{ tanggal($progress->created_at, 'd F Y H:i') }}
                                    <br />
                                    {{ $progress->note }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </td>
            </tr>
        @endforeach
    @endif

</table>
