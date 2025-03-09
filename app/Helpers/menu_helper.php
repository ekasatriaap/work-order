<?php

if (!function_exists('getMenu')) {
  function getMenu()
  {
    $menu = [];
    $menu = [
      [
        "name" => "Manajemen User",
        "icon" => "fas fa-users",
        "child" => [
          [
            "name" => "Users",
            "url" => "user.index",
            "permissions" => ["user.lihat", "user.tambah", "user.ubah", "user.hapus", "user.detail"]
          ],
          [
            "name" => "Roles",
            "url" => "role.index",
            "permissions" => ["role.lihat", "role.tambah", "role.ubah", "role.hapus", "role.detail"]
          ]
        ]
      ],
      [
        "name" => "Master",
        "icon" => "fas fa-database",
        "child" => [
          [
            "name" => "Produk",
            "url" => "produk.index",
            "permissions" => ["produk.lihat", "produk.tambah", "produk.ubah", "produk.hapus"]
          ]
        ]
      ],
      [
        "name" => "Work Order",
        "icon" => "fas fa-list",
        "child" => [
          [
            "name" => "Penugasan",
            "url" => "penugasan.index",
            "permissions" => ["penugasan.lihat", "penugasan.tambah", "penugasan.ubah", "penugasan.hapus", "penugasan.detail"]
          ],
          [
            "name" => "Tugas",
            "url" => "tugas.index",
            "permissions" => ["tugas.lihat", "tugas.ubah", "tugas.detail"]
          ],
        ]
      ],
      [
        "name" => "Laporan",
        "icon" => "fas fa-file",
        "child" => [
          [
            "name" => "Work Order",
            "url" => "laporan-work-order.index",
            "permissions" => ["laporan-work-order.lihat"]
          ],
          [
            "name" => "Petugas",
            "url" => "laporan-petugas.index",
            "permissions" => ["laporan-petugas.lihat"]
          ]
        ]
      ]
    ];
    return $menu;
  }
}

if (!function_exists('getAllPermissionMenu')) {
  function getAllPermissionMenu($menu, $permissions = [], $only = null)
  {
    if (!empty($menu['permissions'])) {
      foreach ($menu['permissions'] as $key => $value) {
        if ($only) {
          $explode = explode('.', $value);
          if ($explode[1] != $only) continue;
        }
        $permissions[] = $value;
      }
    }

    if (!empty($menu['child'])) {
      foreach ($menu['child'] as $key => $child) {
        $permissions = getAllPermissionMenu($child, $permissions, $only);
      }
    }

    return $permissions;
  }
}

if (!function_exists('getAllMenuUrl')) {
  function getAllMenuUrl($menu, $urls = [])
  {

    if (!empty($menu['url'])) {
      $urls[] = $menu['url'];
    }

    if (!empty($menu['child'])) {
      foreach ($menu['child'] as $key => $child) {
        if (!empty($child['url'])) $urls[] = $child['url'];

        if (isset($child['child'])) {
          $urls = array_merge(array_column($child['child'], 'url'), $urls);
        }
      }
    }

    return $urls;
  }
}

if (!function_exists('setupPermissionMenu')) {
  function setupPermissionMenu($menu, $role_permissions, $tab = 1)
  {
    $defaultJsTree = '{ "type" : "file" }';
    $openJsTree = '{"opened": true}';
    $HTML = "<ul>";

    $emptyChild = empty($menu['child']);
    $HTML .= "<li data-jstree='" . ($emptyChild ? $defaultJsTree : $openJsTree) . "' data-name='{$menu['name']}' data-tab='{$tab}'>{$menu['name']}";
    if (isset($menu['permissions'])) {
      foreach ($menu['permissions'] as $k => $permission) {
        $__prs = explode('.', $permission);
        $checked = in_array($permission, $role_permissions) ? 'checked' : null;
        $icon = getPengaturanIconMenu($__prs[1], $checked);
        $text = $__prs[1];
        $alias = $menu['alias'][$permission] ?? $text;
        $alias = str_replace("_", " ", $alias);

        $HTML .= "<label class='ms-2' $checked data-text='$text' data-alias='$alias' data-icon='$icon' data-name='" . encode($permission) . "'>
                        <span class='$icon'></span>
                    </label>";
      }
    }
    if (!$emptyChild) {
      foreach ($menu['child'] as $key => $child) {
        $HTML .= setupPermissionMenu($child, $role_permissions, $tab);
      }
    }
    $HTML .= "</li>";
    $HTML .= "</ul>";
    return $HTML;
  }
}

if (!function_exists('getPengaturanIconMenu')) {
  function getPengaturanIconMenu($permission, $checked = null)
  {
    if ($permission == 'lihat') return "fas fa-eye " . ($checked ? 'text-default' : 'text-secondary');
    if ($permission == 'tambah') return "fas fa-plus-circle " . ($checked ? 'text-primary' : 'text-secondary');
    if ($permission == 'ubah') return "fas fa-edit " . ($checked ? 'text-warning' : 'text-secondary');
    if ($permission == 'hapus') return "fas fa-trash " . ($checked ? 'text-danger' : 'text-secondary');
    if ($permission == 'detail') return "fas fa-info-circle " . ($checked ? 'text-info' : 'text-secondary');
    if ($permission == 'sync_feeder') return "fas fa-sync " . ($checked ? 'text-success' : 'text-secondary');
    if ($permission == 'login') return "fas fa-lock " . ($checked ? 'text-success' : 'text-secondary');
    return;
  }
}
