<?php 
    
    //$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)
    //print_r($_POST);
        if(!empty($_POST)){
            //print_r($_REQUEST);
            $userName = $_POST["userName"];
            $userPass = $_POST["userPassword"];

            $mysqli_query = "select userId, userName, email, phone, desig AS designation from tbl_user where (userName = '".$userName."' OR email = '".$userName."' OR phone = '".$userName."') AND userPass = '".md5($userPass)."' AND isActive = 1 limit 1";

            //$result = mysqli_query($conn, $mysqli_query);
            $result1 = $mysqli->query($mysqli_query);

            if ($result1){
                $userObj = $result1->fetch_object();
                print_r($userObj);
                //echo $result1->num_rows;
                    if($result1->num_rows == 1){
                        $_SESSION["uid"] = $userObj->userId;
                        $_SESSION["uname"] = $userObj->userName;
                        $_SESSION["desig"] = $userObj->designation;
                        //echo "here 1<br/>";
                        //exit;
                        header("location:./index.php?page=dashboard");
                        exit;
                }
                    else{
                        $msg = '<div class="alert alert-warning mt-2">Enter Valid UESERNAME & PASSWORD</div>';
                }
            }
                //mysqli_close($conn);
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Login</title>
</head>
<body>
    <div class="mt-5 text-center" style="font-size: 40px; ">
    <i class="fas "></i>
    <span>Bharatiya Itihasha Sankalana Sameeti</span>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center mt-3">
            <div class="col-sm-6 col-md-4">
                <form action="./index.php?page=login" method="post" class="shadow-lg p-4">
                    <div class="form-group">
                        <i class= "fas fa-user"></i>
                            <lable for="name" class="font-weight-bold pl-2"> User Name </lable>
                                <input type="text" class="form-control" name="userName" id="" placeholder="mobile or email id" size="50" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <i class= "fas fa-key"></i>
                            <lable for="name" class="font-weight-bold pl-2"> Password </lable>
                                <input type="password" class="form-control" name="userPassword" placeholder="password" size="50" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-outline-danger mt-3 font-weight-bold btn-block shadow-sm"> Submit </button>
                    <?php if(!empty($_POST)) {
                            echo $msg;
                    }?>
                </form>
                <div class="text-center"><a href="index.php" class="btn btn-info mt-3 font-weight-bold shadow-sm">Back To Home</a></div>
            </div>
        </div>
    </div>        
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/all.min.js"></script> 
</body>
</html>