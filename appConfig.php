<?php

$dbhost = "localhost:3307";
$dbuser = "root";
$dbpass = "";
$dbname = "db_iHistory";

$designationArray = array("SA"=>"Super Admin","REV"=>"Reviewer","MOD"=>"Moderator");
$status = array("1"=>"Enable","0"=>"Disable");
$globalData = array("designations"=>$designationArray,"status"=>$status);
?>