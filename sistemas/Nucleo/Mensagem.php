<?php

namespace sistema\Nucleo;

class Mensagem 
{
  private $texto;
  public $css;

  function __toString()
  {
   return $this->redenrizar(); 
  }

  public function sucesso(string $mensagem) : mensagem
  {
    $this->css = 'alert alert-success';
    $this->texto = $this->filtrar($mensagem);
    return $this;
  }

  public function error(string $mensagem) : mensagem
  {
    $this->css = 'alert alert-danger';
    $this->texto = $this->filtrar($mensagem);
    return $this;
  }

  public function alerta(string $mensagem) : mensagem
  {
    $this->css = 'alert alert-warning';
    $this->texto = $this->filtrar($mensagem);
    return $this;
  }

  public function redenrizar () : string
  {
     return $this->texto = "<div class='{$this->css}'>{$this->texto}</div>";
  }

  private function filtrar (string $mensagem) : string
  {
    return filter_var(strip_tags($mensagem), FILTER_SANITIZE_SPECIAL_CHARS);
  } }
