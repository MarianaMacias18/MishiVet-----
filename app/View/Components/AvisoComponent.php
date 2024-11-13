<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class AvisoComponent extends Component
{
    public $titulo;
    public $mensaje;
    public $botonTexto;
    

    public function __construct($titulo, $mensaje, $botonTexto)
    {
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->botonTexto = $botonTexto;
       
       
    }

    public function render()
    {
        return view('components.aviso-component');
    }
}
