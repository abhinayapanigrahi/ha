<?php
include("./classes/applicationClass.php");

class usersPrcessor extends applicationProcessor{
    function getAllUsers(){
        //$mysqliCon = $this->sqlConect();
        //echo "all users List Printed";
            $mysqli_query = "select userId, userName, email, phone from tbl_user";

            $result1 = $this->sqlConect()->query($mysqli_query);
            $resultsArr = array();
            if ($result1){

            while($userObj = $result1->fetch_object()){
                array_push($resultsArr, $userObj);
            }

            //echo $result1->num_rows;

            return $resultsArr;
            }
    }
    function getUserDetails($userID){

           $mysqli_query1 = "select * from tbl_user where userId = ".$userID;
            
            $result2 = $this->sqlConect()->query($mysqli_query1);
            $resultsArr1 = array();
            if ($result2){

            while($userObj = $result2->fetch_object()){
                array_push($resultsArr1, $userObj);
            }
        }

            return $resultsArr1;
    }


    function saveUserDetails($userObject){
        print_r($userObject);
            if(!isset($userObject['Submit'])){
                if(($userObject['username']) == "" || (md5($userObject['password'])) == "" || ($userObject['confirmpassword']) == "" || ($userObject['emailid']) == "" || ($userObject['mobileno']) == "" || ($userObject['designation']) == "" ){
                    echo "All Fields Are Required";
                }
            else{
                $username = $userObject['username'];
                $password = md5($userObject['password']);
                $confirmpassword = $userObject['confirmpassword'];
                $emailid = $userObject['emailid'];
                $mobileno = $userObject['mobileno'];
                $designation = $userObject['designation'];
                $isactive = $userObject['isactive'];

                $mysqli_query = "insert into tbl_user (userName, userPass, email, phone, desig,isactive) values ('$username','$password','$emailid', '$mobileno', '$designation','isactive')";
                $this->sqlConect()->query($mysqli_query);  
                return $this->sqlConect()->insert_id;
                }
            
            }

            

    }
    function updateUserDetails($userObject){
        print_r($userObject);
            $username = $userObject['username'];
            $password = md5($userObject['password']);
            //$confirmpassword = $userObject['confirmpassword'];
            $emailid = $userObject['emailid'];
            $mobileno = $userObject['mobileno'];
            $designation = $userObject['designation'];
            $isActive = $userObject['isactive'];
            $sqlStr = "";
            $sqlArr = array();
            
            if(!empty($userObject['username'])){
               // $sqlStr .= " userName = '".$username."', ";
                array_push($sqlArr," userName = '".$username."'");
            }
            if(!empty($userObject['password'])){
               // $sqlStr .= "userPass = '".$password."', ";
                array_push($sqlArr,"userPass = '".$password."'");
            }
            if(!empty($userObject['emailid'])){
               // $sqlStr .= "email = '".$emailid."', ";
                array_push($sqlArr,"email = '".$emailid."'");
            }
            if(!empty($userObject['mobileno'])){
               // $sqlStr .= "phone = '".$mobileno."', ";
                array_push($sqlArr,"phone = '".$mobileno."'");
            }
            if(!empty($userObject['isactive'])){
               // $sqlStr .= "isActive = '".$isActive."', ";
                array_push($sqlArr,"isActive = '".$isActive."'");
            }
            if(!empty($userObject['designation'])){
               // $sqlStr .= "desig = '".$designation."'";
                array_push($sqlArr,"desig = '".$designation."'");
            }

            $sqlStr = implode($sqlArr,", ");
            
            $mysqli_query = " update tbl_user set ".$sqlStr." where userId = ".$userObject['editID'];
            
            $this->sqlConect()->query($mysqli_query); 
            //return $this->sqlConect()->updatedId;   
    }
}
?>

