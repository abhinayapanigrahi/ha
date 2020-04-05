<?php 
    
    //$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)
    //print_r($_POST);
    if(!empty($_POST)){
    //print_r($_REQUEST);
        $userName = $_POST["userName"];
        $userPass = $_POST["userPassword"];

        $mysqli_query = "select userId, userName, email, phone from tbl_user where (userName = '".$userName."' OR email = '".$userName."' OR phone = '".$userName."') AND userPass ='".md5($userPass)."' AND isActive =1";

    //$result = mysqli_query($conn, $mysqli_query);
        $result1 = $mysqli->query($mysqli_query);

    if ($result1){
            $userObj = $result1->fetch_object();
                print_r($userObj);
                //echo $result1->num_rows;
        if($result1->num_rows == 1){
                $_SESSION["uid"] = $userObj->userId;
                $_SESSION["uname"] = $userObj->userName;
                //echo "here 1<br/>";
                //exit;
                header("location:./index.php?page=dashboard");
                exit;
                }
        else{
            echo "redirect to logout giving message as user doesnot exists";
        }
    }
    //mysqli_close($conn); 
} 

?>
<form action="./index.php?page=login" method="post" name="loginform">
    <table colspacing="0" align="center" width="40%" >
        <tr>
            <td colspan="2" align="center" class="tableHead">User Login</td>
        </tr>
        <tr>
            <td class="label"><lable for="name"> User Name </lable></td>
            <td class="input"><input type="text" name="userName" id="" placeholder="mobile or email id" required></td>
        </tr>
        <tr>
            <td><lable for="name"> Password </lable></td>
            <td><input type="password" name="userPassword" placeholder="password" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit"> Submit </button></td>
        </tr>
    </table>
</form>