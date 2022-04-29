<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function clean($value) {
        $value = trim($value);            
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
}





function checkLogin() {
    session_start();
    if(isset($_SESSION['logged']) && isset($_SESSION['email'])){
        return;
    }
    else{
        header("Location: ../adminlogin/ha-admin.php?err");
        die;
    }
}

function deliveryLogin() {
    session_start();
    if(isset($_SESSION['deliver'])){
        return;
    }
    else{
        header("Location: ../deliver/login.php");
        die;
    }
}

function customerLogin(){
    session_start();
    if(isset($_SESSION['customer'])){
        return true;
    }else{
        header("Location: ../public/login.php");
    }
}

function cLogged(){
    if(isset($_SESSION['customer'])){
        return true;
    }else{
        return false;
    }
}

function otpGenerate() {
    $otp = random_int(100000, 999999);
    return $otp;
}

function sendMail($otp) {
    require_once "../PHPMAiler/PHPMailer.php";
    require_once "../PHPMAiler/Exception.php";
    require_once "../PHPMAiler/SMTP.php";
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'store.homeappliance@gmail.com';                     //SMTP username
    $mail->Password   = 'Home@123';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('store.homeappliance@gmail.com', 'Home Appliance Store');
    $mail->addAddress('store.homeappliance@gmail.com');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'OTP for Admin Login';
    $mail->Body    = "OTP for Admin Login<br>OTP for login is: <b>".$otp."</b> <br><p style='color:green;'> This is the otp for your login. Do not share OTP with anybody.</p>";
    $mail->AltBody = 'This is the otp for your login. Do not share OTP with anybody.';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}