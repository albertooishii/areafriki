<?php

    class Email
    {
        var $to;//receptor
        var $from;//emisor
        var $from_name;//nombre de emisor
        var $subject;//asunto
		var $body;//cuerpo email
        var $reply_to;
        var $reply_to_name;

        function getEmail($file,$data=false)
        {
            ob_start();                      // start capturing output
            include DIR.'/app/views/email/'.$file.'.php';   // execute the file
            $page = ob_get_contents();    // get the contents from the buffer
            ob_end_clean();
            ob_start();
            include DIR.'/app/views/email/page.php';
            $content = ob_get_contents();
            ob_end_clean();
            $this->body=$content;
        }


        function sendEmail()
        {
            if(empty($this->from)){$this->from=NOREPLY_EMAIL;}
            if(empty($this->from_name)){$this->from_name=PAGE_NAME;}
            if(empty($this->reply_to)){$this->reply_to=NOREPLY_EMAIL;}
            if(empty($this->reply_to_name)){$this->reply_to_name=PAGE_NAME;}
            require_once DIR.'/vendor/PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer();
            $mail->isSMTP();
            // $mail->SMTPDebug = 2;
            $mail->Host = SMTP_HOST;
            $mail->Port = SMTP_PORT;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = SMTP_SECURE;
            $mail->Username = SMTP_EMAIL;
            $mail->Password = SMTP_PASS;
            $mail->setFrom($this->from, $this->from_name);
            $mail->addReplyTo($this->reply_to, $this->reply_to_name);
            $mail->addAddress($this->to, $this->to);
            $mail->Subject = DEBUG ? "[TEST]".$this->subject : $this->subject;
            //$mail->AltBody="Cuerpo alternativo del mensaje en solo texto";
            $mail->msgHTML($this->body);
            //$mail->AddAttachment("ruta/archivoadjunto.jpg");
            $mail->CharSet = "UTF-8";
            //$mail->Encoding = "quotedprintable";
            if ($mail->Send())
            {return true;}else{$mail->ErrorInfo;return false;}
        }

    }
?>
