<x-app-layout :title="$title">
    <x-row>
        <div class="col-md-12">
            <x-card :title="$title">
                @slot('toolbar')
                    @can("$permission_name.tambah")
                        <a class="btn btn-sm btn-primary" href="{{ route("{$permission_name}.create") }}">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    @endcan
                @endslot

                <x-form method="GET" id="form-filter">
                    <x-card-filter class="mb-5">
                        <div class="col-lg-9">
                            <x-form-select-inline label="Status" class="form-select-sm" name="fstatus" id="status"
                                :options="$status" placeholder="Semua status.." value="" />
                            <x-form-input-inline type="date" label="Tanggal" class="form-select-sm" name="ftanggal"
                                id="tanggal" value="" />
                        </div>
                    </x-card-filter>
                </x-form>

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
                setFilterDataTable(['#status', '#tanggal'], `#${DATATABLE_ID}`);
            });
        </script>
    @endpush
</x-app-layout>
