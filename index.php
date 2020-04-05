<!DOCTYPE html>
<?php include("application_top.php"); ?>
<html>
<head>
	<link rel="stylesheet" href="./css/index.css" />
</head>
<body>

<div class="header">
      <div class="logo">
         <a href="./index.php">Logo</a>
      </div>
         <div class="top">
            <?php include("./includes/topmenu.php"); ?>
            <?php include("./includes/usermenu.php");?>    
         </div>
</div>
<div class="main">
      <div class="left">
         <?php include("./includes/left_block.php"); ?>
      </div>
      <div class="right">
         <?php
            $page = null;
            
            if(isset($_GET) && isset($_GET['page'])){ $page = $_GET['page']; }
            $page = (empty($page))?"home":$page;
            $page = getPage($page);
            include_once($page.".php");
         
         ?> 
      </div>  
</div>
<div class="footer">
   <h3 style="color:darkgreen">Contact Us Link | Social media links</h3>
</div>

</body>
</html>