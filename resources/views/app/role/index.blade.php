<x-app-layout :title="$title">
    <x-row>
        <div class="col-md-12">
            <x-card :title="$title">
                @slot('toolbar')
                    @can("$permission_name.tambah")
                        <button type="button" class="btn btn-sm btn-primary" data-title="Tambah Role"
                            data-url="{{ route("{$permission_name}.create") }}" onclick="actionModalData(this)">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
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
    @endpush
</x-app-layout>
