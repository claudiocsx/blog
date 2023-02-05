<?php
namespace sistema\Nucleo;

use Exception;

class Helps
{
  
  // Arquivo de funçoes

  public static function validarCpf(string $cpf) : bool 
{
  $cpf = self::limparNumero($cpf);

  if (mb_strlen($cpf) != 11 or preg_match('/(\d)\1{10}', $cpf)){
    throw new Exception('O cpf precisa ter 11 digito');
  }
  for ($t = 9; $t < 11; $t++){
    for ($d = 0, $c =0; $c < $t; $c++){
      $d += $cpf[$c] * (($t + 1) - $c);
    }
    $d = ((10 * $d) % 11) % 10;
    if($cpf[$c] != $d){
      throw new Exception('cpf invalido');
    } 
  }
  return true;
}

public static function limparNumero(string $numero) :string
{
  return preg_replace('/[^0-9]','',$numero);
}

function slug (string $string) : string
{
  $mapa['a'] = 'ÀÁÂÃÄÅÆÇÈÉËÌÍÏÐÑÓÒÔÖØÙÚÛÜuÝÞßáàâãäåæçèéêëìíîïðñòóôõöøùúû@#$%&*()_-+={[}]/?!¨|;:.,\\\'<>°ºª ""  ';

  $mapa['b'] = 'aaaaaaaceeeiiiidnooooooouuuuuybsaaaaaaaceeeeiiiidnooooooouuu                                                                               ';

  $slug = strtr(utf8_decode($string), utf8_decode($mapa['a']), $mapa['b']);

  $slug = strip_tags(trim($slug));
  $slug = str_replace(' ', '-', $slug);
  $slug = str_replace(['--------', '------','----', '---', '--', '-'], '-', $slug);

  return strtolower((utf8_decode($slug)));
}

function dataAtual() : string
{
  $diaMes = date('d');
  $diaSemana = date('w');
  $mes = date('n') - 1;
  $ano = date('Y');
$diasDasemana = ['domingo','segunda','terça','quarta','quinta','sexta','sabado']; $meses = ['janeiro','fervereiro','março','abril','maio','junho','julho','agosto','setembro','outobro','novembro','desembro'];

  $dataFormatada = $diasDasemana[$diaSemana].','.$diaMes.' de '.$meses[$mes].' de '.$ano;

  return $dataFormatada;
}

/**
 * Monta url de acordo com o ambiente 
 * @param string $url parte da url ex.admin
 * @return string url completa 
 */

 public static function url (string $url= null) : string
{
  $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');

  $ambiente = ($servidor == 'localhost' ? URL_DESENVOLVIMENTO : URL_PRODUCAO);

  if(str_starts_with($url, '/'))
  {
    return $ambiente.$url;
  }

  return $ambiente.'/'.$url;

}

function localhost () : bool
{
  $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');

  if($servidor == 'localhost')
  {
    return true;
  }

  return false;
}

/**
 * Validador de url
 * @param string $url
 * @return boll
 */

function validarUrl(string $url) : bool { if(mb_strlen($url) <= 10)
  {
    return false;
  }
  if(!str_contains($url, '.'))
  {
    return false;
  }
  if(str_contains($url, 'http//') or str_contains($url, 'https//'))
  {
    return true;
  }
  return false;
}

function validarUrlComFiltro(string $url) : bool
{
  return filter_var($url, FILTER_VALIDATE_URL);
}

/**
 * Validador de email
 * @param string $email
 * @return boll
 */

function validarEmail(string $email) : bool
{
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}


/**
 * Contar o tempo decorido de uma dara
 * @param string $data
 * @return string
 */

function contarTempo (string $data) : string
{
   $agora = strtotime(date('Y-m-d H:i:s'));
   $tempo = strtotime($data);
   $difenca = $agora - $tempo;

   $segundos = $difenca;
   $minutos = round($difenca / 60);
   $hora = round($difenca / 3600);
   $dias = round($difenca / 86400);
   $semanas = round($difenca / 604800);
   $meses = round($difenca / 2419200);
   $anos = round($difenca / 29030400);
  
   if($segundos <= 60)
   {
     return 'agora';
   }
   elseif($minutos <= 60)
   {
     return $minutos == 1 ? 'há um minuto' : 'há'. $minutos.'minutos';
   }
   elseif($hora <= 24)
   {
     return $hora == 1 ? 'há 1 hora' : 'há '. $hora.'horas';
   } 
   elseif($dias <= 7)
   {
     return $dias == 1 ? 'ontem' : 'há'. $dias.'mdias';
   } 
   elseif($semanas <= 4)
   {
     return $semanas == 1 ? 'há 1 semana' : 'há'. $semanas.'semanas';
   } 
   elseif($meses <= 12)
   {
     return $meses == 1 ? 'há 1 meses' : 'há'. $meses.'meses';
   } 
   else
   {
     return $anos == 1 ? 'há 1 ano' : 'há'. $anos.'anos';
   } 
}

function formatarValor (float $valor = null) : string 
{
  return number_format(($valor ? $valor : 0), 2, ',', '.');
}

/**
 * Formata numero
 * @param string $valor numero para ser formatado
 * @return string Numero formatado
 */

function formatarNumero(string $valor = null) : string
{
  return number_format($valor ? : 0 , 0, ',', '.');
}



public static function Saudacao () : string
{
   echo $hora = date('H');

  if($hora >= 0 and $hora <= 5){
    $saudacao = 'boa madrugada';
  }
  elseif($hora >= 6 and $hora <= 12)
  {
    $saudacao = 'bom dia ';
  }
  elseif($hora >= 13 and $hora <= 18)
  {
    $saudacao = 'boa tarde';
  }
  else{
    $saudacao = ' boa noite';
  }

  return $saudacao;}

/**
 * Resume um texto
 *
 * @param string $texto testo para resumir
 * @param int $limite quantidade de caracteres
 * @param string $continue opcional - o que deve ser exibido no final do resumo
 * @return string texto resumido
 *
 */

function resumeTexto ( string $texto, int $limite, string $continue = '...') : string
{
  $textoLimpo = trim(strip_tags($texto));
  if(mb_strlen($textoLimpo <= $limite))
  {
    return $textoLimpo;
  }

  $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite),''));

  return $resumirTexto.$continue;
}
}
