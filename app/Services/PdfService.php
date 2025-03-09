<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use iio\libmergepdf\Merger;
use Intervention\Image\ImageManagerStatic as Image;


class PdfService
{
  protected $title = "";
  protected $pdf;
  protected $view;
  protected $data = [];
  protected $paper = ['a4', 'portrait'];
  protected $image;

  public function setTitle($title = "")
  {
    $this->title = $title . '_' . date('YmdHis') . ".pdf";
    return $this;
  }

  public function setView($view)
  {
    $this->view = $this->view . '.' . $view;
    return $this;
  }

  public function setData(array $data)
  {
    $this->data = $data;
    return $this;
  }

  public function setPaper($size = 'a4',  $orientation = 'portrait')
  {
    $this->paper = [$size, $orientation];
    return $this;
  }

  public function setPdf()
  {
    $contxt = stream_context_create([
      'ssl' => [
        'verify_peer' => FALSE,
        'verify_peer_name' => FALSE,
        'allow_self_signed' => TRUE,
      ]
    ]);

    $pdf = PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    $pdf->getDomPDF()->setHttpContext($contxt)->setPaper($this->paper[0], $this->paper[1]);
    return $pdf->loadView($this->view, $this->data);
  }

  public function preview()
  {
    return $this->setPdf()->stream($this->title, array("Attachment" => false));
  }

  public function download()
  {
    return $this->setPdf()->download($this->title);
  }

  public function output(array $options = [])
  {
    return $this->setPdf()->output($options);
  }

  public function save($location)
  {
    return $this->setPdf()->save($location);
  }
}
