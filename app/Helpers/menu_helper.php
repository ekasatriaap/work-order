<?php

if (!function_exists('getMenu')) {
  function getMenu()
  {
    $menu = [];
    $menu = [
      [
        "name" => "Dashboard",
        "url" => "cms.dashboard",
        "icon" => "fas fa-tachometer-alt",
      ],
      [
        "name" => "Master",
        "icon" => "fas fa-database",
        "child" => [
          [
            "name" => "Kategori",
            "url" => "cms.kategori.index",
          ],
          [
            "name" => "Users",
            "url" => "cms.users.index"
          ]
        ]
      ],
      [
        "name" => "Berita",
        "url" => "cms.news.index",
        "icon" => "fas fa-newspaper",
      ],
      [
        "name" => "Pages",
        "url" => "cms.pages.index",
        "icon" => "fas fa-file-alt",
      ],
      [
        "name" => "Portofolio",
        "url" => "cms.portofolio.index",
        "icon" => "fas fa-images",
      ],
      [
        "name" => "Setting",
        "icon" => "fas fa-cog",
        "child" => [
          [
            "name" => "Sliders",
            "url" => "cms.slider.index",
          ],
          [
            "name" => "Web Setting",
            "url" => "cms.web_setting.edit",
          ],
          [
            "name" => "Beranda Web",
            "url" => "cms.setting_beranda_web.edit",
          ],
          [
            "name" => "Menu",
            "url" => "cms.menu.index",
          ]
        ]
      ]
    ];
    return $menu;
  }
}
