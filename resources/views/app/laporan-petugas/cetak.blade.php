<x-pdf-layout :title="$title">
    <main>
        <div class="w-full text-center" style="padding:3px; margin-top:5px">
            <span class="d-block uppercase fw-bold" style="font-size: 14px">{{ $title }}</span>
        </div>

        <div class="w-full text-left" style="padding:3px; margin-top:5px">
            <span class="d-block uppercase fw-bold" style="font-size: 14px">penerima tugas: {{ $penerima_tugas->name }}
                ({{ $penerima_tugas->role->name }})</span>
        </div>

        <table class="w-full table-body mt-10" cellpadding="0" cellspacing="0" style="font-size:12px">
            <thead>
                <tr class="uppercase">
                    <th class="borderleft text-center">kode produk</th>
                    <th class="borderleft">nama produk</th>
                    <th class="borderleft text-center">jumlah permintaan</th>
                    <th class="borderleft text-center">jumlah realisasi</th>
                    <th class="borderleft text-center">status</th>
                    <th class="borderleft borderright">progress</th>
                </tr>
            </thead>
            <tbody>
                @if ($tasks->isEmpty())
                    <tr class="borderbottom">
                        <td colspan="6" class="borderleft borderright text-center">{{ DATA_TIDAK_DITEMUKAN }}</td>
                    </tr>
                @else
                    @foreach ($tasks as $task)
                        <tr class="borderbottom">
                            <td colspan="6" class="borderleft borderright">
                                {{ $task->no_wo }} .::. {{ TASK_STATUS[$task->status] }} - Deadline:
                                {{ tanggal($task->deadline, 'd F Y H:i') }}
                            </td>
                        </tr>
                        @if ($task->task_dt->isEmpty())
                            <tr class="borderbottom">
                                <td colspan="6" class="borderleft borderright text-center">Detail
                                    {{ DATA_TIDAK_DITEMUKAN }}
                                </td>
                            </tr>
                        @else
                            @php
                                $total = count($task->task_dt);
                            @endphp
                            @foreach ($task->task_dt as $detail)
                                <tr
                                    class="{{ $loop->iteration == $total ? 'borderbottom' : '' }} {{ $loop->iteration % 2 == 0 ? 'odd' : '' }}">
                                    <td class="text-center borderleft">{{ $detail->produk->kode_produk }}</td>
                                    <td>{{ $detail->produk->nama_produk }}</td>
                                    <td class="text-center">
                                        {{ $detail->jumlah }}
                                    </td>
                                    <td class="text-center">
                                        {{ $detail->jumlah_real }}
                                    </td>
                                    <td class="text-center">
                                        {{ TASK_STATUS[$detail->status] }}
                                    </td>
                                    <td class="borderright">
                                        @if ($detail->progress->isNotEmpty())
                                            <ul>
                                                @foreach ($detail->progress as $progress)
                                                    <li>
                                                        {{ TASK_STATUS[$progress->status] }} - {{ $progress->jumlah }}
                                                        pcs
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
                    @endforeach
                @endif
            </tbody>
        </table>
    </main>
    <style>
        .table-body thead tr td {
            padding: 5px 3px;
            border-bottom: 0px;
        }

        .table-body thead tr th {
            border-bottom: 1px solid #000;
            border-top: 1px solid #000;
            padding: 5px 3px;
            vertical-align: top;
        }

        .table-body tbody tr td,
        .table-body tbody tr th {
            border: 0px;
            border-right: 1px;
            border-top: 1px;
            padding: 5px 3px;
            vertical-align: top;
        }

        table tr th.borderright,
        table tr td.borderright {
            border-right: 1px solid #000 !important;
        }

        table tr th.borderleft,
        table tr td.borderleft {
            border-left: 1px solid #000 !important;
        }

        table tr th.borderbottomblack,
        table tr td.borderbottomblack {
            border-bottom: 1px solid #000 !important;
        }

        .bordertop td,
        .bordertop th {
            border-top: 1px solid #000 !important;
        }

        .borderbottom th,
        .borderbottom td {
            border-bottom: 1px solid #000 !important;
        }

        .odd>* {
            background: #f6f6f6 !important;
        }
    </style>
</x-pdf-layout>
