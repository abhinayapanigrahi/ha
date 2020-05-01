<?php

$dbhost = "localhost:3307";
$dbuser = "root";
$dbpass = "";
$dbname = "db_ihistory";

$designationArray = array("SA"=>"Super Admin","ADM"=>"Admin","REV"=>"Reviewer","MOD"=>"Moderator");
$status = array("1"=>"Enable","0"=>"Disable");
$globalData = array("designations"=>$designationArray,"status"=>$status);

$articlelist = array("1"=>"One", "2"=>"Two","3"=>"Three");
$categorytype = array("Tags"=>"Tags","TM"=>"Top Menu", "LM"=>"Left Menu","Artcles"=>"Articles","Events"=>"Events");
$parentcategorylist = array("1"=>"One", "2"=>"Two","3"=>"Three");
$globalCategoryData = array("articlelist"=>$articlelist,"categorytype"=>$categorytype,"parentcategorylist"=>$parentcategorylist);

$status = array("1"=>"Enable","0"=>"Disable");
$globalContentData = array("status"=> $status);

$articletype = array("CONT"=>"Content","EVNT"=>"Events","NEWS"=>"News");
$globalArticleData = array("articletype"=>$articletype);
?>