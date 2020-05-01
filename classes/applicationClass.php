<?php

class applicationProcessor{
    public $mysqli;
    function __construct(){
        $this->prepareDBConnection();
    }  
    function prepareDBConnection(){
        $dbhost = "localhost:3307";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "db_ihistory";
        
        $this->mysqli = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

        if(! $this->mysqli ) {
            var_dump($this->mysqli);
            die('Could not connect: ');
        }
        /* check connection */
        //if (mysqli_connect_errno()) {
           // printf("Connect failed: %s\n", mysqli_connect_error());
            //exit();
        //}
    }
    function sqlConect(){
        return $this->mysqli;
    }
}

?>