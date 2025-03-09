<div class="row">
    <div class="col-md-6">
        <x-form-select :label="__('Penerima Tugas')" id="id-penerima-tugas" name="id_penerima_tugas" :options="$penerima_tugas"
            :value="old('id-penerima-tugas', $penugasan->id_penerima_tugas)" placeholder="--- Pilih Penerima Tugas ---" />
    </div>
    <div class="col-md-6">
        <x-form-input :label="__('Tenggat Waktu')" type="datetime-local" id="deadline" name="deadline" :value="old('deadline', $penugasan->deadline)" />
    </div>
</div>
