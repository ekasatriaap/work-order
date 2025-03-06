<?php

namespace App\View\Components;

use App\Models\Menu;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $title;

    public function __construct($title = null)
    {
        $this->title = $title ?? "Dashboard";
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $auth = auth()->user();
        switch ($auth->is_root) {
            case 1: //super user
                $menus = getMenu();
                break;
            default:
                $menus = json_decode(Menu::where('id_role', $auth->id_role)->first()?->toArray()['menu'] ?? "[]", true);
                break;
        }
        $app = [
            "title" => $this->title,
            "menus" => $menus
        ];
        return view('layouts.app-layout', $app);
    }
}
