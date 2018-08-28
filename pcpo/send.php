<?php

require 'classes/PHPMailerAutoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// echo $name;
// echo $email;
// echo $phone;
// echo $message;

if ($name && $email && $phone && $message){

  $mail = new PHPMailer;
  $confirm = new PHPMailer;

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'platinumcateringpartyoccasions';                 // SMTP username
  $mail->Password = 'Platinumcatering';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to

  $confirm->isSMTP();                                      // Set mailer to use SMTP
  $confirm->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $confirm->SMTPAuth = true;                               // Enable SMTP authentication
  $confirm->Username = 'platinumcateringpartyoccasions';                 // SMTP username
  $confirm->Password = 'Platinumcatering';                           // SMTP password
  $confirm->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $confirm->Port = 465;                                    // TCP port to connect to

  $mail->setFrom('enquiries@platinumcateringandparties.co.uk', 'Website Contact Form');
  $mail->addAddress('enquiries@platinumcateringandparties.co.uk');               // Name is optional
  $mail->addReplyTo($email, $name);

  $confirm->setFrom('enquiries@platinumcateringandparties.co.uk', 'Platinum Catering & Party Occasions');
  $confirm->addAddress($email);     // Add a recipient
  $confirm->addReplyTo('enquiries@platinumcateringandparties.co.uk', 'Platinum Catering & Party Occasions');

  $mail->isHTML(true);
  $confirm->isHTML(true);                                   // Set email format to HTML

  $mail->Subject = 'Enquiry from '. $name;
  $mail->Body    = $message . " <br><br> Email: <b>". $email ."</b><br>Phone: <b>". $phone ."</b>";
  $mail->AltBody = $message . " <br><br> Email: <b>". $email ."</b><br>Phone: <b>". $phone ."</b>";

  $confirm->Subject = 'Thank you for your message!';
  $confirm->Body    = 'Hi '. $name .'!<br><br> We have received your message and will be in touch very soon!<br><br> Have a lovely day!<br><b>Platinum Catering & Party Occasions</b>';
  $confirm->AltBody = 'Hi '. $name .'!

                      We have received your message and will be in touch very soon!

                      Have a lovely day!
                      Platinum Catering & Party Occasions';

  if(!$mail->send()) {
    $json = array('status' => 'fail', 'message' => $mail->ErrorInfo);
    header('Content-Type: application/json');
    echo json_encode($json);
  } else {
      if(!$confirm->send()) {
        $json = array('status' => 'fail', 'message' => $confirm->ErrorInfo);
        header('Content-Type: application/json');
        echo json_encode($json);
      } else {
          $json = array('status' => 'success', 'message' => 'Thanks for your message!');
          header('Content-Type: application/json');
          echo json_encode($json);
      }
  }



}else{
  $json = array('status' => 'fail', 'message' => 'Please enter something into all fields');
  header('Content-Type: application/json');
  echo json_encode($json);
}


?>
