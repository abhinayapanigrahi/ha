<?php
session_start();
require("appConfig.php");
/*
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
      $mysqli = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

         if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
         }*/
$mysqli = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

function getPage($page){
   $returnPage = "";
   switch($page){
      case "users":
      case "dashboard":
      case "contentmanagement":
      $returnPage = "./hadmin/".$page;
      break;
      default:
      $returnPage = $page;
      break;
   }
   return $returnPage;
}
function isSessionActive(){
   if(!empty($_SESSION) && !empty($_SESSION["uid"])){
      return true;
   }else{
      return false;
   }
}
function getLogedInUser(){
   return $_SESSION["uname"];
} 
?>