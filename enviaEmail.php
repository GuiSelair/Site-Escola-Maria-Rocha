<?php

 require_once("./node_modules/PHPMailer/PHPMailerAutoload.php");

 if (isset($_POST["email"])){
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
   $mail->Body = "<strong>Para redefinir sua senha, </strong>
                  <a href='http://www.mariarocha.org.br/'>Clique Aqui!</a>
                  <br><br>
                  <p style='font-size: 10px;'><i>Não responda esta mensagem. Está mensagem é automática e não será respondida</i></p>"; // Texto da mensagem

   // ENVIO DO EMAIL
   $enviado = $mail->Send();  // Limpa os destinatários e os anexos
   $mail->ClearAllRecipients();  // Exibe uma mensagem de resultado do envio (sucesso/erro)

   if ($enviado) {
     header("location: index.php");
   } else {
     echo "Não foi possível enviar o e-mail.";
     echo "Detalhes do erro: " . $mail->ErrorInfo;
   }

 }
