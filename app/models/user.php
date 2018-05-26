<?php
    putenv("TZ=".TIMEZONE);
    date_default_timezone_set(TIMEZONE);
    ini_set('date.timezone', TIMEZONE);
    
    require_once 'app/helpers/database.php';

    class Users_Model extends Database{

        var $id, $user, $email, $pass, $name, $phone, $address, $cp, $pais, $provincia, $localidad, $rol, $ip, $descripcion, $ocupacion, $intereses, $paypal, $banco, $iban, $birthday, $idnum, $codigo_beta, $credito, $referral, $wp_id;

        function __construct(){
           parent::__construct();
        }

        // Read functions-----------------------------------------------------//
        //Lista completa de usuarios
        function getUsers($filter=false)
        {
            switch($filter){
                case 'active':
                    $query="SELECT * FROM users WHERE active=1";
                break;

                default:
                    $query="SELECT * FROM users";
            }
            if($answer=$this->_db->query($query)){
                while($fila = $answer->fetch_assoc()){
                    $lista_usuarios[]=$fila;
                }
                if(!empty($lista_usuarios)){
                    return $lista_usuarios;
                }else{
                    return false;
                }
            }
        }

        // Leer info usuario desde nombre usuario
        function getUser()
        {
            $query = "SELECT * FROM users WHERE user LIKE '$this->user'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        // Leer info usuario desde id
        function getUserFromID(){
            $query = "SELECT * FROM users WHERE id='$this->id'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        // Leer info usuario desde id
        function getUserFromEmail(){
            $query = "SELECT * FROM users WHERE email='$this->email'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        function isAdmin(){
            $query = "SELECT rol FROM users WHERE id='$this->id'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if($answer["rol"]=='admin')
            return true;
            return false;
        }

        function getRol(){
            $query = "SELECT rol FROM users WHERE user='$this->user'";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["rol"];
            return false;
        }

        function countUsers(){
            $query="SELECT count(*) as count FROM users";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["count"];
        }

        function countNewUsers(){
            $query="SELECT count(*) as count FROM users WHERE DATE(creation_date) = DATE(NOW())";
            $answer = $this->_db->query($query)->fetch_assoc();
            return $answer["count"];
        }

        function puedeVender(){
            $query="SELECT idnum, birthday, iban, paypal FROM users WHERE id=$this->id";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                if($answer["idnum"] && $this->calculaedad($answer["birthday"])>=18 && ($answer["iban"]) || $answer["paypal"]){
                    return true;
                }
            }else{
                return false;
            }
        }

    // Write functions-----------------------------------------------------//

        // Update user info -- Actualizar información de usuario
        function updateProfile()
        {
            $query = "UPDATE users SET description='$this->descripcion', ocupacion='$this->ocupacion', intereses='$this->intereses' WHERE id='$this->id'";
            if ( $this->_db->query($query))
            return true;
            return false;
        }

        function updateUserInformation()
        {
            if($this->pais==28){//Si es español
                $query="UPDATE users SET email='$this->email', pais='$this->pais', birthday='$this->birthday', idnum='$this->idnum', address='$this->address', cp='$this->cp', localidad='$this->localidad', provincia='$this->provincia', phone='$this->phone' WHERE id='$this->id'";
            }else{//Si no es español
                $query="UPDATE users SET email='$this->email', pais='$this->pais', birthday='$this->birthday', idnum=NULL, address=NULL, cp=NULL, localidad=NULL, provincia=NULL, phone='$this->phone' WHERE id='$this->id'";
            }
            if ( $this->_db->query($query))
            return true;
            return false;
        }

        function updateUserCash()
        {
            $query="UPDATE users SET paypal='$this->paypal', banco='$this->banco', iban='$this->iban' WHERE id='$this->id'";
            if ( $this->_db->query($query))
            return true;
            return false;
        }

        // Update user password -- Actualizar contraseña usuario
        function updatePassword(){
            $pass=sha1(GLOBAL_TOKEN.$this->pass);
            $query="UPDATE users SET pass=UNHEX('$pass') WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function setUserWPid() {
            $query="UPDATE users SET wp_id = ".$this->wp_id." WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function convertirVendedor(){
            $query="UPDATE users SET idnum='$this->idnum', paypal='$this->paypal', birthday='$this->birthday', rol='vendedor' WHERE id='$this->id'";
            if ( $this->_db->query($query))
            return true;
            return false;
        }

    //Avatar functions-----------------------------------------------------//

        // Read if user has avatar -- Comprobar si el usuario tiene avatar
        function getAvatar($size=300){
            //comrpobar si tiene avatar subido, sino se muestra el generico
            $dir="app/templates/frontoffice/img/avatar";
            //if(!$size){$size=150;}
            $avatar=$dir."/".$this->user2URL($this->user)."/".$size.".jpg?d=".time();
            $generic_avatar=$dir."/"."user.svg";
            $query = "SELECT avatar FROM users WHERE id='$this->id'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer["avatar"]==1){
                $img=$avatar;
            }
            else{
                $img=$generic_avatar;
            }
            return $img;
        }

        // Comprobar si el usuario tiene banner
        function getBanner($size=1920){
               //comrpobar si tiene banner subido, sino se muestra el generico
            $dir="app/templates/frontoffice/img/banner";
            //if(!$size){$size=1920;}
            $banner=$dir."/".$this->user2URL($this->user)."/".$size.".jpg?d=".time();
            $generic_banner=$dir."/"."banner.jpg";
            $query = "SELECT banner FROM users WHERE id='$this->id'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer["banner"]==1){
                $img=$banner;
            }
            else{
                $img=$generic_banner;
            }
            return $img;
        }

        //Activate user avatar
        function activateAvatar(){
            $query = "UPDATE users SET avatar = 1 WHERE user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        //Deactivate user avatar
        function deleteAvatar($id){
            $query = "UPDATE users SET avatar = 0 WHERE user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        //Activate user avatar
        function activateBanner(){
            $query = "UPDATE users SET banner = 1 WHERE user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        //Deactivate user avatar
        function deleteBanner($id){
            $query = "UPDATE users SET banner = 0 WHERE user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

    // Register & login functions-----------------------------------------------------//

        // Insert User
        function set()
        {
            $new_date=date ("Y-m-d H:i:s");
            $pass=sha1(GLOBAL_TOKEN.$this->pass);

            if(isset($this->referral)){
                $query = "INSERT INTO users (user, email, pass, name, creation_date, creation_ip, rol, referral) VALUES ('$this->user', '$this->email', UNHEX('$pass'), '$this->name' ,'$new_date', '$this->ip', '$this->rol', '$this->referral')";
            }else{
                 $query = "INSERT INTO users (user, email, pass, name, creation_date, creation_ip, rol) VALUES ('$this->user', '$this->email', UNHEX('$pass'), '$this->name' ,'$new_date', '$this->ip', '$this->rol')";
            }
            if ( $this->_db->query($query) )
            return mysqli_insert_id($this->_db);
            return false;
        }

        function validateCodigoBeta(){
            $query="SELECT usado FROM codigos_beta WHERE codigo='".$this->codigo_beta."'";
            $answer = $this->_db->query($query)->fetch_assoc();
            if($answer["usado"]==0)
            return true;
            return false;
        }

        //Register user
        function register(){
            if($this->id=$this->set()){
                if ($this->sendActivationMail()){
                    if($this->login()){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                   return false;
                }
            }else{
                return false;
            }
        }

        function validarBeta(){
            $query="SELECT * FROM codigos_beta WHERE codigo='$this->codigo_beta' AND usado=0";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                $query="UPDATE codigos_beta SET usado=1 WHERE codigo='$this->codigo_beta'";
                if ( $this->_db->query($query))
                return true;
                return false;
            }else{
                return false;
            }
        }

        function sendActivationMail(){

            $data["email_key"]=md5($this->id . sha1(GLOBAL_TOKEN.$this->pass) . EMAIL_TOKEN);
            require_once DIR.'/app/models/email.php';
            $mail = new Email();
            $mail->to = $this->email;
            $mail->subject = "Activacion de cuenta en ". PAGE_NAME;
            $data["username"]=$this->user;
            $mail->getEmail('register_user', $data);
            if ($mail->sendEmail()){
                return true;
            }else{
                return false;
            }
        }

        //Login user
        function login($loginrec=false){
            //PASSWORD=SHA1(GLOBAL_TOKEN.MD5(PASS)) EL PASSWORD DEBE LLEGAR AQUÍ CON EL MD5 YA PUESTO
            $pass=sha1(GLOBAL_TOKEN.$this->pass);
            if(isset($this->user)){
                $query = "SELECT id, user, email, name, description, active FROM users WHERE user='$this->user' AND pass=UNHEX('$pass')";
                $answer = $this->_db->query($query)->fetch_assoc(); //bd_password
            }elseif(isset($this->email)){
                $query = "SELECT id, user, email, name, description, active FROM users WHERE email='$this->email' AND pass=UNHEX('$pass')";
                $answer = $this->_db->query($query)->fetch_assoc(); //password and user
                $this->user=$answer["user"];
            }

            if ($answer!=NULL){
                //borramos sesion por si hay otra iniciada de otro usuario
                unset($_SESSION["login"]);

                //asignamos el nombre de usuario tal y como lo hemos leido en la base de datos (para evitar problemas de mayusculas y minúsculas)
                $this->user=$answer["user"];
                $this->id=$answer["id"];
                $this->email=$answer["email"];

                $this->updateUser_date();//actualiza ultimo acceso
                $this->updateUser_ip();//actualiza ultima ip
                $this->updateVecesLogin();//contamos veces que ha hecho login
                $_SESSION['login']['user']=$this->user;
                $_SESSION['login']['pass']=$this->pass; //password solo con el md5

                if($loginrec==1){
                    setcookie("user", $this->user, time()+2678400, '/');
                    setcookie("pass", $this->pass, time()+2678400, '/');
                }
                return $answer;
            }
            return false;
        }

        //Logout user
        function logout(){
            unset($_SESSION["login"]);
            setcookie("user", '', time()-2678400, '/');
            setcookie("pass", '', time()-2678400, '/');
            session_destroy();
            Header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
            Header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            Header("Cache-Control: no-store, no-cache, must-revalidate");
            Header("Cache-Control: post-check=0, pre-check=0", false);
            Header("Pragma: no-cache");
			Header("Location: ".PAGE_DOMAIN);
        }

        function coincideUserAndPassword(){
            $pass=sha1(GLOBAL_TOKEN.$this->pass);
            $query = "SELECT * FROM users WHERE user='$this->user' AND pass=UNHEX('$pass')";
            $answer = $this->_db->query($query)->fetch_assoc(); //bd_password

            if ($answer!=NULL){
                return true;
            }else{
                return false;
            }
        }


//Regeneración de contraseña
        function existeUsuario()
        {
             if(isset($this->user)){
                $query = "SELECT email, pass FROM users WHERE user='$this->user'";
                $answer = $this->_db->query($query)->fetch_assoc(); //bd_password
                $this->email=$answer["email"];
            }elseif(isset($this->email)){
                $query = "SELECT user, pass FROM users WHERE email='$this->email'";
                $answer = $this->_db->query($query)->fetch_assoc(); //password and user
                $this->user=$answer["user"];
            }
            if ($answer!=NULL)
            return true;
            return false;

        }

        function generarKeyPassword()
        {
            $query="SELECT last_date, last_ip FROM users WHERE user='$this->user'";
            $answer = $this->_db->query($query)->fetch_assoc();
            $recoverpasskey=sha1(EMAIL_TOKEN.md5($answer["last_date"].$answer["last_ip"].$this->user));
            $query = "UPDATE users SET recoverpasskey=UNHEX('$recoverpasskey') WHERE user='$this->user'";
            if ($this->_db->query($query))
            return $recoverpasskey;
            return false;
        }

        function validarRecoverpasskey($recoverpasskey)
        {
            $query="SELECT email FROM users WHERE recoverpasskey=UNHEX('$recoverpasskey')";
            $answer = $this->_db->query($query)->fetch_assoc();
            if($answer!=NULL){
                $this->email=$answer["email"];
                return true;
            }else{
                return false;
            }
        }

        function recoverPassword()
        {
            $pass=sha1(GLOBAL_TOKEN.$this->pass);
            $query="UPDATE users SET pass=UNHEX('$pass'), recoverpasskey=NULL WHERE email='$this->email'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

//Activación de cuenta
        // Read if account is active: 1-> true, 0->false
        function getUser_activeaccount()
        {
            $query = "SELECT active FROM users WHERE user='$this->user'";
            $answer = $this->_db->query($query)->fetch_row();
            if ($answer[0]==1)
            return true; //active
            return false; //not active
        }

        //Active user account
        function activate($email_key)
        {
            //$email_key=md5($id . sha1(GLOBAL_TOKEN . $this->pass) . EMAIL_TOKEN);
            //md5($id . sha1(GLOBAL_TOKEN.$this->pass) . EMAIL_TOKEN);
            $pass=sha1(GLOBAL_TOKEN . $this->pass);
            if(isset($this->user)){
                $query = "SELECT id FROM users WHERE user='$this->user' AND pass=UNHEX('$pass')";
            }elseif(isset($this->email)){
                $query = "SELECT id FROM users WHERE email='$this->email' AND pass=UNHEX('$pass')";
            }
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL){
                //$data["email_key"]=md5($this->id . sha1(GLOBAL_TOKEN.$this->pass) . EMAIL_TOKEN);
                $newkey=md5($answer["id"] . $pass . EMAIL_TOKEN);
                //echo "newkey: ".$newkey."-email_key: ".$email_key;
                if ($newkey==$email_key){
                    $query = "UPDATE users SET active=1 WHERE id='".$answer["id"]."'";
                    if ( $this->_db->query($query))
                    return true;
                    return false;
                }
                return false;
            }else{
                return false;
            }
        }

        function vecesLogueado()
        {
            $query="SELECT num_logins FROM users WHERE user='$this->user'";
            $answer = $this->_db->query($query)->fetch_row();
            return $answer[0]; //veces logueado
        }

        //Update lastDate -- Actualizar último acceso
        function updateUser_date()
        {
            $new_date=date ("Y-m-d H:i:s");
            $query = "UPDATE users SET last_date='$new_date' WHERE user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        //Update lastIP -- Actualizar últimaIP
        function updateUser_ip()
        {

            if (preg_match( "/^([d]{1,3}).([d]{1,3}).([d]{1,3}).([d]{1,3})$/", getenv('HTTP_X_FORWARDED_FOR'))){
                $last_ip=getenv('HTTP_X_FORWARDED_FOR');
            }else{
                $last_ip=getenv('REMOTE_ADDR');
            }

            $query = "UPDATE users SET last_ip='$last_ip' WHERE user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function updateVecesLogin()
        {
            $query = "UPDATE users SET num_logins=num_logins+1 WHERE user='$this->user'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function updateCredito()
        {
             $query = "UPDATE users SET credit=credit+$this->credito WHERE id='$this->id'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        function genera_codigos_registro() {
            $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M','N','O','P','Q', 'R','S','T','U','V','W','X','Y','Z');

            $long = 8;

            $this->token = '';
            for($i = 0; $i < $long; $i++) {
                $this->token .= $chars[rand(0, count($chars)-1)];
            }

            // Ahora consultas si ya existe.
            // Si existe, vuelves a llamar a la funcion

            $query= "INSERT INTO codigos_registro (codigo, usado) VALUES ('$this->token', 0)";

            if ( $this->_db->query($query) )
            return true;
            return $this->genera_codigos_registro();
        }

        function user2URL($username){
            return str_replace(" ", "-", $username);
        }

        function URL2user($urluser){
            return str_replace("-", " ", $urluser);
        }

        function calculaedad($fechanacimiento){
            list($ano,$mes,$dia) = explode("-",$fechanacimiento);
            $ano_diferencia  = date("Y") - $ano;
            $mes_diferencia = date("m") - $mes;
            $dia_diferencia   = date("d") - $dia;
            if ($dia_diferencia < 0 || $mes_diferencia < 0)
                $ano_diferencia--;
            return $ano_diferencia;
        }
    }
?>
