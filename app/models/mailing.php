<?php
    require_once 'app/helpers/database.php';

    class Mailing_Model extends Database{
        var $email, $date, $user;

        function __construct(){
           parent::__construct();
        }

        // Lectura-----------------------------------------------------//
        function get()
        {
            $query = "SELECT * FROM mailing";
            $answer = $this->_db->query($query)->fetch_assoc();
            if ($answer!=NULL)
            return $answer;
            return false;
        }

        //Escritura-----------------------------------------------------//
        function set()
        {
            $this->date=date ("Y-m-d H:i:s");
            if(!empty($this->user)){
                $query="INSERT INTO mailing (email, date, user) VALUES ('$this->email', '$this->date', '$this->user')";
            }else{
                $query="INSERT INTO mailing (email, date) VALUES ('$this->email', '$this->date')";
            }
            if ( $this->_db->query($query) )
            return true;
            return false;
        }

        //Borrado---------------------------------------------------------//
        function remove()
        {
            $query="DELETE FROM mailing WHERE email='$this->email'";
            if ( $this->_db->query($query) )
            return true;
            return false;
        }
    }

?>
