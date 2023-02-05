<?php


namespace sistemas\Crontrolador;

include 'sistemas/Nucleo/Controlador.php';


use sistema\Nucleo\Controlador;

class SiteControlador extends Controlador
{
    public function __construct() 
    {
        parent::__construct('sistemas/templates/site/views');
    }

    public function index() :void
    {
        echo $this->template->renderizar('index.html', [
          'titulo' => 'teste de titulo',
          'subtitulo'=>'teste de subtitulo'
        ]);
    }
    public function sobre() :void
    {
        echo $this->template->renderizar('sobre.html',[
            'titulo' => 'sobre'
        ]);
    }   
}
