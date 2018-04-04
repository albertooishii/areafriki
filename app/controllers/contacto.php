<?php
    class Contacto extends Controller{

        function index_contacto(){
            $data['page_title'] = "Página de contacto";
            $data["contact_msg"]="";
            if ($_POST){
                $this->loadModel('email');
                $mail = New Email();
                $mail->reply_to_name=$mail->from_name=$data["name"]=$_POST["name"];
                $mail->reply_to=$mail->from=$data["email"]=$_POST["email"];
                $data["phone"]=$_POST["phone"];
                $data["text"]=$_POST["text"];
                $mail->subject="[FORMULARIO] - ".$_POST["subject"];
                
                switch ($_POST["email-destino"]){
                    case 'ERROR_EMAIL':
                        $mail->to=ERROR_EMAIL;
                    break;
                    case 'SUPPORT_EMAIL':
                        $mail->to=SUPPORT_EMAIL;
                    break;
                    default:
                        $mail->to=CONTACT_EMAIL;
                }
                $mail->body=$this->loadView('email','contact',$data);
                if($mail->sendEmail()){
                    $data["contact_msg"]=$this->loadView('success','form_success',"Mensaje enviado correctamente.");
                }else{
                    $data["contact_msg"]=$this->loadView('error','form_error',"Error al enviar el formulario de contacto.");
                }
            }
            $data["custom_js"]="<script src='".PAGE_DOMAIN."/app/views/contacto/contacto.js'></script>";
            $this->render('contacto', 'contacto', $data);
        }
    }
?>