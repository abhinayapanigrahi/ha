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
        $dbname = "db_iHistory";
        
        $this->mysqli = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

        if(! $this->mysqli ) {
            var_dump($this->mysqli);
            die('Could not connect: ');
        }
    }
    function sqlConect(){
        return $this->mysqli;
    }
}

?>