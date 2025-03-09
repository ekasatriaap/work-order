<x-app-layout :title="$title">
    <x-row>
        <div class="col-md-12">
            <x-card :title="$title">
                @slot('toolbar')
                    <a href="{{ route("{$permission_name}.index") }}" class="btn btn-sm btn-danger btn-icon icon-left"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                @endslot

                <x-detail-data :details="$details" />
            </x-card>

            <x-card title="Detail Penugasan">
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
