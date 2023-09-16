<?php
//Importe classes PHPMailer para o namespace global
//Eles devem estar no topo do seu script, não dentro de uma função
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['enviar'])) {
    $mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Habilitar saída de depuração detalhada
    $mail->isSMTP();                                            //Enviar usando SMTP
    $mail->Host       = 'email-ssl.com.br';                     //Defina o servidor SMTP para enviar
    $mail->SMTPAuth   = true;                                   //Habilitar autenticação SMTP
    $mail->Username   = 'email@dominio.com.br';                     //Nome de usuário SMTP
    $mail->Password   = 'senhadoemail';                               //Senha SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Habilitar criptografia TLS implícita
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('email@dominio.com.br', 'Teste forms Locaweb'); 
    $mail->addAddress('email@dominio.com.br', 'Nome');     //Adicionar um destinatário
    $mail->addReplyTo('email@dominio.com.br', 'Information');
    $mail->isHTML(true);                                  //Defina o formato do e-mail para HTML
    $mail->Subject = 'Mensagem teste - Locaweb';

    $body = "Mensagem enviada atraves do site, segue informacoes abaixo:<br>
    Nome: $_POST[nome]<br>
    E-mail: $_POST[email]<br>
    Mensagem:<br>
    $_POST[msg]";

    $mail->Body    = $body;
    $mail->send();
    echo 'Enviado com sucesso';
    } catch (Exception $e) {
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
}else {
    echo "Erro ao enviar e-mail";
}