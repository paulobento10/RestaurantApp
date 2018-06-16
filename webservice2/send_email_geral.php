<?php

require_once __DIR__ . "/../../vendor/autoload.php";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

class Mail
{

  public function mail_send_reserva($nome,$email,$data,$hora,$qtd_pessoas,$rota)
  {
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    $re=file_get_contents('http://engprows.dev/obtain/id/'.$rota);
    $re=json_decode($re);
    try {
      //Server settings
      $mail->SMTPDebug = 0;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'labproaulas@gmail.com';                 // SMTP username
      $mail->Password = 'Labproaulas10';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;

      // TCP port to connect to
      //Recipients
      $mail->setFrom('labproaulas@gmail.com','Recover');
      $mail->addAddress($email,$nome);     // Add recipient
      $mail->setFrom('labproaulas@gmail.com','Reserva efetuada no '.$re[0]->nome);
      $mail->isHTML(false);                                  // Set email format to HTML
      $mail->Subject = 'Reserva';
      $mail->Body    = 'Acabou de efetuar uma reserva no restaurante '.$re[0]->nome.' na rua '.$re[0]->morada.' ,para o dia '.$data.' ,hora '.$hora.' , para '.$qtd_pessoas. ' pessoa/s. 

      Que corra tudo bem!';

      //$mail->addAttachment($img);
      $mail->send();
      //echo 'Message has been sent';
    }
    catch (Exception $e)
    {
      echo $email.'Mailer Error:'. $mail->ErrorInfo;
    }
  }
}
?>
