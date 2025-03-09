<x-app-layout :title="$title">
    <x-row>
        <div class="col-md-12">
            <x-card :title="$title">
                <x-form method="POST" action='{{ route("{$permission_name}.cetak") }}' target="_blank">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <x-form-select-inline label="Status" class="form-select-sm" name="fstatus" id="status"
                                :options="$status" placeholder="Semua status.." value="" />
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    <i class="fas fa-print"></i> Cetak
                                </button>
                            </div>
                        </div>
                    </div>
                </x-form>
            </x-card>
        </div>
    </x-row>
</x-app-layout>
