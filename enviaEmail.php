<?php

//////////////////////////////////////
////      PÁGINA ENVIA EMAIL      ////
//////////////////////////////////////
 
 include_once("conexao/config.php");
 include_once("conexao/conexao.php");
 include_once("conexao/function.php");

 require_once("./node_modules/PHPMailer/PHPMailerAutoload.php");

 if (isset($_POST["tipo"]) && $_POST["tipo"] == "escola" && isset($_POST["email"])){
    $emailDestino = $_POST["email"];
    $conexao = DBConecta();
    $sql_code = "SELECT * FROM mr_usuarios WHERE email='$emailDestino'";
    $results = mysqli_query($conexao, $sql_code);
    
    // EXISTE O EMAIL NO BANCO DE DADOS
    if ($results && mysqli_num_rows($results)){
        $hash = md5(time());
        if (AddHash($conexao, $hash, $emailDestino)){
            $mail = new PHPMailer();
            // DEFINIÇÃO DOS DADOS DE AUTENTICAÇÃO
            $mail->IsSMTP(); // Define que a mensagem será SMTP
            $mail->Host = "smtp.mariarocha.org.br"; // Seu endereço de host SMTP
            $mail->SMTPAuth = true; // Define que será utilizada a autenticação -  Mantenha o valor "true"
            $mail->Port = 587; // Porta de comunicação SMTP - Mantenha o valor "587"
            $mail->SMTPSecure = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
            $mail->SMTPAutoTLS = false; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
            $mail->Username = 'escola@mariarocha.org.br'; // Conta de email existente e ativa em seu domínio
            $mail->Password = 'Site2019'; // Senha da sua conta de email

            // DADOS DO REMETENTE
            $mail->Sender = "escola@mariarocha.org.br"; // Conta de email existente e ativa em seu domínio
            $mail->From = "escola@mariarocha.org.br"; // Sua conta de email que será remetente da mensagem
            $mail->FromName = "Escola Estadual de Ensino Médio Professora Maria Rocha"; // Nome da conta de email

            // DADOS DO DESTINATÁRIO
            $mail->AddAddress($emailDestino); // Define qual conta de email receberá a mensagem
            // Definição de HTML/codificação
            $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
            $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

            // DEFINIÇÃO DA MENSAGEM
            $mail->Subject  = "Recuperação de senha"; // Assunto da mensagem
            $mail->Body = "<h3>Você solicitou recuperação de senha?</h3>
                            <hr/>
                            <strong>Para redefinir sua senha, </strong>
                            <a href='http://www.mariarocha.org.br/redefine.php?hash=".$hash."&email=".$emailDestino."'>Clique Aqui!</a>
                            <br><br>
                            <p style='font-size: 12px;'><i>Não responda esta mensagem. Está mensagem é automática e não será respondida.</i></p>"; // Texto da mensagem

            // ENVIO DO EMAIL
            $enviado = $mail->Send();  // Limpa os destinatários e os anexos
            $mail->ClearAllRecipients();  // Exibe uma mensagem de resultado do envio (sucesso/erro)

            if ($enviado) {
                    echo "<div class='alert alert-success alert-dismissable status'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Email enviado com sucesso. Verifique sua caixa de entra ou spam.</strong>
                    </div>";
            } else {
                    echo "<div class='alert alert-warning alert-dismissable status'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Erro ao enviar email. Error: ".$mail->ErrorInfo."</strong>
                    </div>";
            }
        }
    }else{
        echo "<div class='alert alert-danger alert-dismissable status'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Email não cadastrado. Tente novamente.</strong>
        </div>";
    }
 }
 else{
     header("location: index.php");
 }
