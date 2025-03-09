<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LaporanPetugasController extends BaseController
{
    protected $view = "app.laporan-petugas";
    protected $permission_name = "laporan-petugas";
    protected $log_name = "laporan petugas";

    public function index()
    {
        $title = "Laporan Petugas";
        $petugas = User::usersRole()->pluck("user_role", "id");
        return view($this->view . ".index", compact("title", "petugas"));
    }

    public function cetak(Request $request)
    {
        if (empty($request->fid_user)) {
            return redirect()->back()->with("sweet_error", "Pilih petugas terlebih dahulu");
        }

        $id_user = $request->fid_user;
        return (new CetakPDF)->laporanPertugas($id_user)->preview();
    }
}
