<?php

namespace App\Http\Controllers;

use App\DataTables\ProdukDataTable;
use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProdukController extends BaseController
{
    protected $view = "app.produk";
    protected $permission_name = "produk";
    protected $log_name = "produk";

    public function index(ProdukDataTable $dataTable)
    {
        $title = "Produk";
        return $dataTable->setPermission($this->permission_name)
            ->setButton("{$this->view}.button")
            ->render($this->view . ".index", compact("title"));
    }

    public function create()
    {
        notAjaxAbort();
        $produk = new Produk();
        return view($this->view . ".create", compact("produk"));
    }

    public function store(ProdukRequest $request)
    {
        notAjaxAbort();
        $attributes = $request->validated();
        DB::beginTransaction();
        try {
            $store = Produk::create($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityCreate("Tambah {$this->log_name}", $store);
        return responseSuccess(BERHASIL_SIMPAN);
    }

    public function edit($id)
    {
        notAjaxAbort();
        $produk = Produk::findOrFail(decode($id));
        return view($this->view . ".edit", compact("produk"));
    }

    public function update(Request $request, $id)
    {
        notAjaxAbort();
        $id = decode($id);
        $produk = Produk::findOrFail($id);
        $formRequest = new ProdukRequest();
        $validator = Validator::make($request->all(), $formRequest->rules($id), [], $formRequest->attributes());
        $attributes = $validator->validated();
        DB::beginTransaction();
        try {
            $produk->update($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityUpdate("Ubah {$this->log_name}", $produk, $produk->getChanges());
        return responseSuccess(BERHASIL_SIMPAN);
    }

    public function destroy($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $produk = Produk::findOrFail($id);
        DB::beginTransaction();
        try {
            $produk->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_HAPUS;
            return responseFail($message);
        }
        DB::commit();
        $this->activityDelete("Hapus {$this->log_name}", $produk);
        return responseSuccess(BERHASIL_HAPUS);
    }
}
