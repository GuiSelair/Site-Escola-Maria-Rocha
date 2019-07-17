<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './node_modules/PHPMailer/src/Exception.php';
    require './node_modules/PHPMailer/src/PHPMailer.php';
    require './node_modules/PHPMailer/src/SMTP.php';
        
    $email = new PHPMailer();

    $email->isSMTP();
    $email->isHTML(true);
    $email->Charset = "UTF-8";
    $email->SMTPAuth = true;
    $email->SMTPSecure = "SSL";
    
    // NOME DO SERVIDOR
    $email->"br160.hosgator.com.br";
    // PORTA
    $email->Port = 465;
    // EMAIL DO EMITENTE
    $email->Username = "teste@mariarocha.org.br";
    $email->Password = "senha";

    $email->From = "teste@mariarocha.org.br";
    $email->FromName = "Maria Rocha";

    //ASSUNTO
    $email->Subject = "Recuperar de senha";
    // CORPO DA MENSAGEM
    $email->Body = "CONTEUDO....";
    // CORPO DA MENSAGEM EM TEXTO
    $email->AltBody = "CONTEUDO EM TEXTO (PARA INTERNET FRACA)";

    //DESTINATARIO
    $email->AddAddress("destino@teste.com");

    if ($email->Send()){
        echo "Email enviado com sucesso";
    }
    else{
        echo "Falha ao enviar email: ".$email->ErrorInfo;
    }
?>