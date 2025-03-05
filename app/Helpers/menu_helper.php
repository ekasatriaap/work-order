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
            "url" => "users.index",
            "permissions" => ["users.lihat", "users.tambah", "users.edit", "users.hapus", "users.detail"]
          ],
          [
            "name" => "Roles",
            "url" => "peran.index",
            "permissions" => ["peran.lihat", "peran.tambah", "peran.edit", "peran.hapus"]
          ]
        ]
      ]
      // [
      //   "name" => "Master",
      //   "icon" => "fas fa-database",
      //   "child" => [
      //     [
      //       "name" => "Kategori",
      //       "url" => "cms.kategori.index",
      //     ],
      //     [
      //       "name" => "Users",
      //       "url" => "cms.users.index"
      //     ]
      //   ]
      // ],
      // [
      //   "name" => "Berita",
      //   "url" => "cms.news.index",
      //   "icon" => "fas fa-newspaper",
      // ],
      // [
      //   "name" => "Pages",
      //   "url" => "cms.pages.index",
      //   "icon" => "fas fa-file-alt",
      // ],
      // [
      //   "name" => "Portofolio",
      //   "url" => "cms.portofolio.index",
      //   "icon" => "fas fa-images",
      // ],
      // [
      //   "name" => "Setting",
      //   "icon" => "fas fa-cog",
      //   "child" => [
      //     [
      //       "name" => "Sliders",
      //       "url" => "cms.slider.index",
      //     ],
      //     [
      //       "name" => "Web Setting",
      //       "url" => "cms.web_setting.edit",
      //     ],
      //     [
      //       "name" => "Beranda Web",
      //       "url" => "cms.setting_beranda_web.edit",
      //     ],
      //     [
      //       "name" => "Menu",
      //       "url" => "cms.menu.index",
      //     ]
      //   ]
      // ]
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
