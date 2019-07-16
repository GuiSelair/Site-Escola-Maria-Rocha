<?php
   session_start(); 
   header("Content-type: image/jpeg"); // define o tipo do arquivo

    function captcha($largura,$altura,$tamanho_fonte,$quantidade_letras){
        $imagem = imagecreate($largura,$altura); // LARGURA E ALTURA DA CAPTCHA GERADA
        $fonte = "arial.ttf"; // FONTE UTILIZADA
        $preto  = imagecolorallocate($imagem,0,0,0); // COR DO FUNDO
        $branco = imagecolorallocate($imagem,255,255,255); // COR DA LETRA

        // DEFINE DE MODO ALEATÓRIO AS LETRAS UTILIZADAS COM A QUANTIDADE PASSADA
        $palavra = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQq
        RrSsTtUuVvYyXxWwZz23456789"),0,($quantidade_letras));

        $_SESSION["palavra"] = $palavra; // COLOCA A PALAVRA EM UMA SESSAO
        
        // ANEXA AS LETRAS A IMAGEM
        for($i = 1; $i <= $quantidade_letras; $i++){
            imagettftext($imagem,$tamanho_fonte,rand(-25,25),($tamanho_fonte*$i),
            ($tamanho_fonte + 10),$branco,$fonte,substr($palavra,($i-1),1));
        }
        imagejpeg($imagem); // GERA IMAGEM
        imagedestroy($imagem); // APAGA A IMAGEM DA MEMÓRIA, TORNANDO A IMAGEM ÚNICA
    }

    $largura = $_GET["l"]; 
    $altura = $_GET["a"]; 
    $tamanho_fonte = $_GET["tf"]; 
    $quantidade_letras = $_GET["ql"]; 
    
    captcha($largura,$altura,$tamanho_fonte,$quantidade_letras);
?>
