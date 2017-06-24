 <?php
  	$name;$email;$message;$captcha;
    if(isset($_POST['name'])){
      $name=$_POST['name'];
    }if(isset($_POST['email'])){
      $email=$_POST['email'];
    }if(isset($_POST['message'])){
      $message=$_POST['message'];
    }if(isset($_POST['g-recaptcha-response'])){
      $captcha=$_POST['g-recaptcha-response'];
    }

    $filename ='contact_log.txt';
    $text =$name."\t".$email."\t".$message."\t";
    file_put_contents($filename, $text, FILE_APPEND);

    if(!$captcha){
    file_put_contents($filename,"FAILURE\n", FILE_APPEND);
      throw new Exception("Captcha is empty", 1);
    }
    $secretKey = "<secret key goes here>";
    $ip = $_SERVER['REMOTE_ADDR'];
   
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
 
    $responseKeys = json_decode($response,true);

    if(intval($responseKeys["success"]) !== 1) {
	 file_put_contents($filename,"FAILURE\n", FILE_APPEND);
     throw new Exception("Captcha validation failed", 1);
    } else {
      $name       = @trim(stripslashes($name)); 
      $from       = @trim(stripslashes($email)); 
      $subject    = @trim(stripslashes("contact")); 
      $message    = @trim(stripslashes($message)); 
      $to         = 'to@email.com';

      $headers   = array();
      $headers[] = "MIME-Version: 1.0";
      $headers[] = "Content-type: text/plain; charset=iso-8859-1";
      $headers[] = "From: {$name} <{$from}>";
      $headers[] = "Reply-To: <{$from}>";
      $headers[] = "Subject: {$subject}";
      $headers[] = "X-Mailer: PHP/".phpversion();

      $mail_status = mail($to, $subject, $message, implode("\r\n", $headers));

      if($mail_status){
    	file_put_contents($filename,"SUCCESS\n", FILE_APPEND);
  	  }else{
  	  	file_put_contents($filename,"FAILURE\n", FILE_APPEND);
  	  	throw new Exception("Error sending mail", 1);
  	  }
    }
?> 