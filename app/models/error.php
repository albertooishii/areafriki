<?php
    require_once 'app/helpers/database.php';

    class Error_Model extends Database{

        var $codigo_error, $from_email, $from_name;

        function __construct(){
           parent::__construct();
        }

        function send_email(){
            require_once DIR.'/app/models/email.php';
            $mail = new Email();

            $data["codigo_error"]=$this->codigo_error;
            require_once DIR.'/app/models/email.php';
            $mail = new Email();
            $mail->to = ERROR_EMAIL;
            $mail->from = $this->from_email;
            $mail->from_name = $this->from_name;
            $mail->subject = "Notificación de Error";
            $mail->getEmail('error_send', $data);
            if ($mail->sendEmail()){
                return true;
            }else{
               return false;
            }
        }
    }
?>
