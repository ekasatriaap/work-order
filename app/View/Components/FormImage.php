<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormImage extends Component
{
    public $label;
    public $id;
    public $name;
    public $previewId;
    public $inputId;
    public $default;
    public $imageData;
    /**
     * Create a new component instance.
     */
    public function __construct($label = null, $id = "", $name, $previewId = "image-preview", $inputId = "image-upload", $default = null)
    {
        $this->label = $label;
        $this->id = $id;
        $this->name = $name;
        $this->previewId = $previewId;
        $this->inputId = $inputId;
        $this->imageData = $this->convertImageToBase64($default);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-image');
    }

    private function convertImageToBase64($path): array
    {
        if (empty($path)) {
            return [];
        }
        $get_path = "storage/uploads/{$path}";
        $return = [
            "extension" => "",
            "imageData" => ""
        ];
        if (file_exists(public_path($get_path))) {
            $get_content = file_get_contents(public_path("$get_path"));
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, public_path($get_path));
            $extension = explode('/', $mime_type)[1];
            finfo_close($finfo);
            $imageData = base64_encode($get_content);
            $return = [
                "extension" => $extension,
                "imageData" => $imageData
            ];
        }
        return $return;
    }
}
