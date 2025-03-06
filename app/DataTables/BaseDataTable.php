<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;

class BaseDataTable extends DataTable
{
  protected $permission_name;
  protected $button_view;
  protected $parameter;
  protected $permission_aksi = ['ubah', 'detail', 'hapus']; // default list aksi di datatable

  public function __construct($permission_name = null, $button_view = null)
  {
    $this->permission_name = $permission_name ?? '';
    $this->button_view = $button_view ?? '';
  }

  public function setPermission($permission)
  {
    $this->permission_name = $permission;
    return $this;
  }

  public function setPermissionAksi($aksi)
  {
    $this->permission_aksi = $aksi;
    return $this;
  }

  public function setButton($location_button)
  {
    $this->button_view = $location_button;
    return $this;
  }

  public function setParam($param)
  {
    $this->parameter = $param;
    return $this;
  }

  public function getPermission()
  {
    return $this->permission_name;
  }

  public function getButton()
  {
    return $this->button_view;
  }

  public function getParam()
  {
    return $this->parameter;
  }
}
