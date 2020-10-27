$(document).ready(function(){
    
    $("#addUser").submit(function (){
        
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var role = $("#role").val();
        var dob = $("#dob").val();
        var gender = $("#gender").val();
        var phone = $("#phone").val();
        
        if(fname=="")
        {
            $("#alertDiv").html("First Name cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#fname").focus();
            return false;
        }
        if(lname=="")
        {
            $("#alertDiv").html("Last Name cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#lname").focus();
            return false;
        }
        if(email=="")
        {
            $("#alertDiv").html("Email cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#email").focus();
            return false;
        }
        if(password=="")
        {
            $("#alertDiv").html("Password cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#password").focus();
            return false;
        }
        if(role=="")
        {
            $("#alertDiv").html("Role cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#country").focus();
            return false;
        }
        if(dob=="")
        {
            $("#alertDiv").html("DOB cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#dob").focus();
            return false;
        }
        if(phone=="")
        {
            $("#alertDiv").html("Phone Number cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#phone").focus();
            return false;
        }
        
        var patphone=/^[0-9]{10}$/;
        var patemail=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;
        
        if(!phone.match(patphone))
      {
          $("#alertDiv").html("Phone Number is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#phone").focus();
          return false;
      } 
      if(!email.match(patemail))
      {
          $("#alertDiv").html("Email is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#email").focus();
          return false;
          
      }
        
    });
    
    $("#editUser").submit(function (){
        
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var email = $("#email").val();
        var role = $("#role").val();
        var dob = $("#dob").val();
        var gender = $("#gender").val();
        var phone = $("#phone").val();
        
        if(fname=="")
        {
            $("#alertDiv").html("First Name cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#fname").focus();
            return false;
        }
        if(lname=="")
        {
            $("#alertDiv").html("Last Name cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#lname").focus();
            return false;
        }
        if(email=="")
        {
            $("#alertDiv").html("Email cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#email").focus();
            return false;
        }
        if(password=="")
        {
            $("#alertDiv").html("Password cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#password").focus();
            return false;
        }
        if(role=="")
        {
            $("#alertDiv").html("Role cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#country").focus();
            return false;
        }
        if(dob=="")
        {
            $("#alertDiv").html("DOB cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#dob").focus();
            return false;
        }
        if(phone=="")
        {
            $("#alertDiv").html("Phone Number cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#phone").focus();
            return false;
        }
        
        var patphone=/^[0-9]{10}$/;
        var patemail=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;
        
        if(!phone.match(patphone))
      {
          $("#alertDiv").html("Phone Number is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#phone").focus();
          return false;
      } 
      if(!email.match(patemail))
      {
          $("#alertDiv").html("Email is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#email").focus();
          return false;
          
      }
        
    });
    
    
}); 