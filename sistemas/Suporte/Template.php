<?php  

namespace sistemas\Suporte;

include 'sistemas/Nucleo/Helps.php';

use Twig\Lexer;
use sistema\Nucleo\Helps;

class Template{
    private \Twig\Environment $twig;

    public function __construct(string $diretorio)
    {
        $loader = new \Twig\Loader\FilesystemLoader($diretorio); 
        $this->twig = new \Twig\Environment($loader); 
        $lexer = new Lexer($this->twig, array(
            $this->helpers()
        )); 
        $this->twig->setLexer($lexer);
    }

    public function renderizar(string $view, array $dados) : string 
    {
        return $this->twig->render($view, $dados);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    private function helpers() :void
    {
        array(
            $this->twig->addFunction(
                new \Twig\TwigFunction('url',function(string $url = null){
                    return Helps::url();
                })
            )
        ); 
    }
    
}

