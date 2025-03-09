<x-app-layout :title="$title">
    <x-row>
        <div class="col-md-12">
            <x-card :title="$title">
                @slot('toolbar')
                    <a href="{{ route("{$permission_name}.index") }}" class="btn btn-sm btn-danger btn-icon icon-left"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                    @if ($penugasan->status == TASK_STATUS_PENDING)
                        <button class="btn btn-sm btn-primary btn-icon icon-left" id="btn-save" type="button">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    @endif
                @endslot
                <x-form action='{{ route("{$permission_name}.update", encode($penugasan->id)) }}' method="POST"
                    id="form-form">
                    @method('put')
                    @include($resource_view . '._form')
                </x-form>
            </x-card>

            <x-card title="Detail Penugasan">
                @slot('toolbar')
                    @can("$permission_name.tambah")
                        @if ($penugasan->status != TASK_STATUS_COMPLETED && $penugasan->status != TASK_STATUS_CANCELED)
                            <button type="button" class="btn btn-sm btn-primary" data-title="Tambah Detail"
                                data-url="{{ route("{$permission_name}-detail.create") }}?id={{ encode($penugasan->id) }}"
                                onclick="actionModalData(this)">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        @endif
                    @endcan
                @endslot

                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-striped']) }}
                </div>
            </x-card>

        </div>
    </x-row>
    @push('add-scripts')
        {!! $dataTable->scripts() !!}
        <script>
            $(document).ready(function() {
                $(`#btn-save`).click(function() {
                    $(`#form-form`).submit();
                });
            });
        </script>
    @endpush
</x-app-layout>
