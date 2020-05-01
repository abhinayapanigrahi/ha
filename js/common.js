validateUserForm = (formObj) => {
  console.log(formObj);
  alert("Validating User Form");
  if (document.getElementById("username").value == "") {
    alert("Please Enter Username");
    document.getElementById("username").focus();
    return false;
  }

  /* 
  if((username.length<=5)||(username.length>=20)){
    document.getElementById("username").innerHTML="The length must between 5 to 20 ";
    return false;
   }
   if(!isNaN(username)){
    document.getElementById("username").innerHTML="Only Charecters are allowed";
    return false;
   }
  */
  if (document.getElementById("password").value == "") {
    alert("Please Enter Password");
    document.getElementById("password").focus();
    return false;
  }
  /* 
  if((pass.length<=5)||(pass.length>=20)){
    document.getElementById("passwords").innerHTML="The length must between 5 to 20 ";
    return false;
   }
   if(pass!=confirm.pass){
    document.getElementById("confrmpass").innerHTML="Passwords are not matching";
    return false;
   }
  */
  if (document.getElementById("confirmpassword").value == "") {
    alert("Please Confirm The Password");
    document.getElementById("confirmpassword").focus();
    return false;
  }
  if (document.getElementById("emailid").value == "") {
    alert("Please Enter Valid Emailid");
    document.getElementById("emailid").focus();
    return false;
  }
  /*
if(emails.indexOf('@')<=0){
  document.getElementById("emailids").innerHTML="invalid Position"
  return false;
 }
 if((emails.charAt(emails.length-4)!='.')&&(emails.charAt(emails.length-3)!='.')){
  document.getElementById("emailids").innerHTML="**.Inavalid position";
  return false;
 }
*/

  if (document.getElementById("mobileno").value == "") {
    alert("Please Enter 10 Digit Mobile No");
    document.getElementById("mobileno").focus();
    return false;
  }
  /*
if(isNaN(mobileNumber)){
  document.getElementById("mobileno").innerHTML="Please enter only digits";
  return false;
 }
 if(mobileNumber.length!=10){
  document.getElementById("mobileno").innerHTML="NUmber should be in 10 digits";
  return false;
 }
*/

  return true;
};
function reloadMe() {
  location.reload();
}
