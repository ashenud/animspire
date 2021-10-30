$(document).ready(function(){
   
    $("#freelancer_loginform").submit(function(){
        
        var username = $("#username").val();
        var password = $("#password").val();
        
        if((username=="")&&(password==""))
        {
            $("#altermsg").html("<h6>Username & Password cannot be Empty!</h6>");
            $("#altermsg").addClass("alert alert-danger");
            return false;
        }
        else
        {
            if(username=="")
            {
              $("#altermsg").html("<h6>Username cannot be Empty!</h6>");
              $("#altermsg").addClass("alert alert-danger");
              $("#username").focus();
              return false;
            }
            if(password=="")
            {
              $("#altermsg").html("<h6>Password cannot be Empty!</h6>");
              $("#altermsg").addClass("alert alert-danger");
              $("#password").focus();
              return false;
            }
            else{
                return true;
            }
        }
        
        
    });
    
});