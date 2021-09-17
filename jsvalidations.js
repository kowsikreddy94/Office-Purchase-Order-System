function validateRegistrationForm() {
  var FName = document.forms["myForm"]["YourName"].value;
  console.log("Hello world;",FName);
  var Email = document.forms["myForm"]["email"].value;
  var Password = document.forms["myForm"]["password"].value;
  var Confirm_Password = document.forms["myForm"]["repassword"].value;

  var nameformat = /^[a-zA-Z-' ]*$/;
  var mailformat = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
 var password_format=  /^[A-Za-z]\w{7,14}$/;
      
  if (FName == "") {
    alert("First Name field is Empty");
    return false;
  }

  if (Email == "") {
    alert("Email must be filled out");
    return false;
  }

  if (Password == "") {
    alert("Password must be filled out");
    return false;
  }

  if (Confirm_Password == "") {
    alert("Confirm Password must be filled out")
 ;   return false;
  }

  if(Password != Confirm_Password)
  {
      alert("Password does not match with confirm password");
      return false;
  }

  if (Password.match(password_format)) { 
      return true;
  }

  if (FName.match(nameformat)) { 
      return true;
  }
     if (Email.match(mailformat)) { 
      return true;
    }else
    {
        alert("Email or Password is  invalid");
        return false;
    }

}

function validateLoginForm(){
  alert("inside validation form JS method");
  var x = document.forms["lofinForm"]["usrnm"].value;
  if(x == "sam"){
    alert(" POP Up");
    return false;
  }
  return true;
}