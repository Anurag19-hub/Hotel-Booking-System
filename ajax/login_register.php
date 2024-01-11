<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // require '../vendor/phpmailer/src'

    // require 'PHPMailer-master/src/Exception.php';
    // require 'PHPMailer-master/src/PHPMailer.php';
    // require 'PHPMailer-master/src/SMTP.php';
    require_once '../vendor/phpmailer/src/Exception.php';
    require_once '../vendor/phpmailer/src/PHPMailer.php';
    require_once '../vendor/phpmailer/src/SMTP.php';


    require('../admin/inc/db_config.php');
    require('../admin/inc/essential.php');

    date_default_timezone_set("Asia/Kolkata");


function sendMail($email,$v_code)
{
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "anuragjobanputra1979@gmail.com";
        $mail->Password = "dnmqftrdcxipvesy";

        $mail->IsHTML(true);
        $mail->AddAddress($email,$v_code);
        $mail->SetFrom("anuragjobanputra1979@gmail.com", "Anurag");
        $mail->Subject = "Registration Succesfull";
        // $html = "<html";
        $content = "Thanks for registration!
                     Click the link below to verify the email address
                     <a href='http://localhost/serenity/verify.php?email=$email&v_code=$v_code'>Verify</a>";

        $mail->MsgHTML($content);
        if (!$mail->Send()) {
            echo "Error while sending Email.";
            var_dump($mail);
        } else {
            echo "Email sent successfully";
        }

}


if(isset($_POST['login']))
{
   $data = filteration($_POST);

   $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `username`=?",[$data['email_username'],$data['email_username']],"ss");

   if(mysqli_num_rows($u_exist) == 0)
   {
        echo 'inv_email_username';
   }
   else
   {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0)
        {
            echo 'not_verified';
        }
        else
        {
            if(!password_verify($data['pass'],$u_fetch['password']))
            {
                echo 'invalid_pass';
            }
            else
            {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $u_fetch['id'];
                $_SESSION['uName'] = $u_fetch['username'];

                echo 1;
            }
        }
   }
}
    

if(isset($_POST['register']))
{
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `username`=? ",[$data['email'],$data['username']],"ss");

    if(mysqli_num_rows($u_exist)!=0)
    {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ?'email_already':'phone_already';
        exit;
    }
    else
    {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $v_code = bin2hex(random_bytes(16));

        $query = "INSERT INTO `user_cred`(`full_name`, `username`, `email`, `password`, `verification_code`) 
        VALUES (?,?,?,?,?)";

        $values = [$data['fullname'],$data['username'], $data['email'],$password, $v_code];


        sendMail($data['email'],$v_code);
        
        if(insert($query,$values,"sssss"))
        {
            echo 1;
        }
        else{
            echo 'ins_failed';
        }
    }
}

if(isset($_POST['forgot_pass']))
{
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? ",[$data['email']],"s");

    if(mysqli_num_rows($u_exist)==0)
    {
        echo 'inv_email';
    }
    else
    {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0)
        {
            echo 'not_verified';
        }
        else
        {

            //send reset link to mail
             $v_code = bin2hex(random_bytes(16));   
            // sendMail($data['email'],$v_code);

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Host = "smtp.gmail.com";
            $mail->Username = "anuragjobanputra1979@gmail.com";
            $mail->Password = "dnmqftrdcxipvesy";
    
            $mail->IsHTML(true);
            $mail->AddAddress($email,$v_code);
            $mail->SetFrom("anuragjobanputra1979@gmail.com", "Anurag");
            $mail->Subject = " password changed! ";
            // $html = "<html";
            $content = "Thanks for registration!
                         Click the link below to verify the email address
                         <a href='http://localhost/serenity/verify.php?email=$email&v_code=$v_code'>Verify</a>";
    
            $mail->MsgHTML($content);
            if (!$mail->Send()) {
                echo "Error while sending Email.";
                var_dump($mail);
            } else {
                echo "Email sent successfully";
            }
        }
    }
}

?>