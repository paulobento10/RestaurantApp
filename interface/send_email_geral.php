<?php

require_once "../vendor/autoload.php";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
session_start();
if(!isset($_SESSION['username'])){
  $_SESSION['username']='';
}
if(!isset($_SESSION['id_edit'])){
  $_SESSION['id_edit']=1;
}
$conn = mysqli_connect("localhost","root","root","labpro");
if(!$conn)
die('Error: ' . mysqli_connect_error());


class Mail{

  public function mail_Send_recover($username)
  {
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    $email="null";
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
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
      $conn= mysqli_connect("localhost","root","root","labpro") or die ("Unable to connect to the database");
      $stuff=mysqli_query($conn,"SELECT id,username,email FROM utilizador");
      while($row = mysqli_fetch_array($stuff))
      {
        if(strcmp($row['username'],$username)==0)
        {
          $email=$row['email'];
          $id=$row['id'];
        }
      }

      //Recipients
      $mail->setFrom('labproaulas@gmail.com','Recover');
      $mail->addAddress($email,$username);     // Add recipient
      //$mail->addAddress('ellen@example.com');               // Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      //Attachments
      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment(__DIR__."/".'recover.pdf', 'users&id');    // Optional name

      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'recover your password';
      $mail->Body    = '<td>'.'<a '.'class="pure-button"'.' href=http://app.dev/lab_project/lab_prog/public/password_forget.php?id='. $id .'> recover </a> </td>';
      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      //echo 'Message has been sent';
    } catch (Exception $e) {
      echo $email.'Mailer Error:'. $mail->ErrorInfo;
    }
  }
  public function mail_send_newsletter()
  {
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    $winner=array();
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
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
      $conn= mysqli_connect("localhost","root","root","labpro") or die ("Unable to connect to the database");
      $stuff=mysqli_query($conn,"SELECT id,nome,email FROM utilizador order by rand() limit 5");
      while($row = mysqli_fetch_array($stuff))
      {
        $mail->addAddress($row['email'],$row['username']);
        $mail->setFrom('labproaulas@gmail.com','WINNER');
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = 'PARABENS';
        $mail->Body    = 'PARABENS !!! ganhou o premio de este test ';
        $mail->send();
      }
    } catch (Exception $e) {
      echo $email.'Mailer Error:'. $mail->ErrorInfo;


      // Add a recipient
      //$mail->addAddress('ellen@example.com');               // Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      //Attachments
      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment(__DIR__."/".'recover.pdf', 'users&id');    // Optional name

      //Content

      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      //echo 'Message has been sent';

    }
  }
}





/*$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
  //Server settings
  $mail->SMTPDebug = 0;                                 // Enable verbose debug output
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'labproaulas@gmail.com';                 // SMTP username 							//AQUI MAIS TARDE USAR $email PARA TER ENVIAR PARA O EMAIL DE CADA UTILIZADOR!!!!! -> $mail->Username = $email;
  $mail->Password = 'Labproaulas10';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom('from@example.com', 'Mailer');
  $mail->addAddress('labproaulas@gmail.com', 'Laboratotio Programacao');     // Add a recipient
  $mail->addAddress('ellen@example.com');               // Name is optional
  $mail->addReplyTo('info@example.com', 'Information');
  $mail->addCC('cc@example.com');
  $mail->addBCC('bcc@example.com');

  //Attachments
  //$mail->AddAttachment("pdfs/".$username.".pdf");

  //Content
  $id=$_SESSION['id_edit'];
  //$id=$_REQUEST['id'];
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'New password request';
  $mail->Body    = 'http://app.dev/lab_project/lab_prog/public/password_forget.php?id='.$id;
  $mail->AltBody = 'http://app.dev/lab_project/lab_prog/public/password_forget.php?id='.$id;

  $mail->send();
  echo 'Message has been sent<br>';



} catch (Exception $e) {
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
}*/
?>
