<?php
if(!isSessionActive()){
    header("location:./index.php?page=logout");
    exit;
}
//print_r($_REQUEST);
include("./classes/userClass.php");
$objUser = new usersPrcessor();

//print_r($userList);
?>

<h1>User Management</h1>
<p> In this Section Adding User, Editing User, Updating User is Completed</p>
<div class="pagewrap">
<a href="./index.php?page=users&action=add">Add User</a>
<?php
$showForm = '';
    if(!empty($_GET) && !empty($_GET["action"]) ){
        switch($_GET["action"]){
            case "add":
            $showForm = 'add';
            break;
            case "edit":
            $editUser = $objUser->getUserDetails($_GET['id']);
            $showForm = 'edit';

            break;
            case "update":

            $editUser = $objUser->updateUserDetails($_POST);
            $showForm = 'update';
            break;
            case "save":
                if(!empty($_REQUEST['submitaddForm'])){
                echo $addedUserId = $objUser->saveUserDetails($_REQUEST);
                }
                
            break;
        }
    }
    $userList = $objUser->getAllUsers();
    if($showForm == 'add'){
        ?>
        
        <form name="adduser" method="POST" action="./index.php?page=users&action=save">
            <h2>Add User</h2>
            <table>
                <tr>
                    <td><lable>User Name</lable></td>
                    <td><input type="text" name="username" /></td>
                </tr>
                <tr>
                    <td><lable>Password</lable>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td><lable>Confirm Password</lable>
                    <td><input type="password" name="confirmpassword" /></td>
                </tr>
                <tr>
                    <td><lable>Email Id</lable></td>
                    <td><input type="text" name="emailid" /></td>
                </tr>
                <tr>
                    <td><lable>Mobile No</lable></td>
                    <td><input type="text" name="mobileno" /></td>
                </tr>
                <tr>
                    <td><lable>Designation</lable></td>
                    <td>
                    <select name="designation" id="designation">
                    <?php
                    foreach ($globalData["designations"] as $k => $v) {
                        ?>
                        <option value="<?php echo $k; ?>"><?php echo  $v; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><lable>Is Active</lable></td>
                    <td>
                    <select name="isactive" id="isactive">
                    <?php
                    foreach ($globalData["status"] as $k => $v) {
                        ?>
                        <option value="<?php echo $k; ?>"><?php echo  $v; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit"> Submit </button>
                    <input type="hidden" name="submitaddForm" value="submit"/>
                    </td>
                    <td><button type="submit"> Cancel </button></td>
                </tr>
            </table>   
            
        </form>
        <?php
    }
    if($showForm == 'edit'){
        //print_r($editUser);
        ?>
        <form name="edituser" method="POST" action="./index.php?page=users&action=update"> 
            <h2>Edit User</h2>
            <table>
                <tr>
                    <td><lable>User Name</lable></td>
                    <td><input type="text" name="username" value="<?php echo $editUser[0]->userName; ?>" /></td>
                </tr>
                <tr>
                    <td><lable>Password</lable>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td><lable>Confirm Password</lable>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td><lable>Email Id</lable></td>
                    <td><input type="text" name="emailid" value="<?php echo $editUser[0]->email; ?>"/></td>
                </tr>
                <tr>
                    <td><lable>Mobile No</lable></td>
                    <td><input type="text" name="mobileno" value="<?php echo $editUser[0]->phone; ?>"/></td>
                </tr>
                <tr>
                    <td><lable>Designation</lable></td>
                    <td>
                    <select name="designation" id="designation">
                    <?php
                    foreach ($globalData["designations"] as $k => $v) {
                        $selected = ($editUser[0]->desig == $k)?'selected="selected"':"";
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $k; ?>"><?php echo  $v; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><lable>Is Active</lable></td>
                    <td>
                    <select name="isactive" id="isactive">
                    <?php
                    foreach ($globalData["status"] as $k => $v) {
                        $selected = ($editUser[0]->isActive == $k)?'selected="selected"':"";
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $k; ?>"><?php echo  $v; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit"> Update </button>
                    <input type="hidden" name="submitaddForm" value="submit"/>
                    <input type="hidden" name="editID" value="<?php echo $_GET["id"]; ?>"/>
                    </td>
                    <td><button type="cancel"> Cancel </button></td>
                </tr>
            </table> 
        </form>
        <?php
    }
?>
    <table cellspacing="0" cellpadding="0" width="100%" border="1">
        <tr>
            <th>#</th>
            <th>UserName</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
            foreach($userList as $key=>$value) {
                ?>
        <tr>
            <td><?php echo $key+1;?></td>
            <td><?php echo $value->userName; ?></td>
            <td><?php echo $value->phone; ?></td>
            <td><?php echo $value->email; ?></td>
            <td><a href="./index.php?page=users&action=edit&id=<?php echo $value->userId; ?>">Edit</a></td>
        </tr><?php 
            }   
        ?>
    </table>
</div>