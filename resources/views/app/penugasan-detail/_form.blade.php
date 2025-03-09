<x-form-select :label="__('Produk')" id="id-produk" name="id_produk" :options="$produks" :value="old('id_produk', $task_dt->id_produk)"
    placeholder="--- Pilih Produk ---" />
<x-form-input type="number" :label="__('Jumlah')" id="jumlah" name="jumlah" :value="old('jumlah', $task_dt->jumlah)" />
