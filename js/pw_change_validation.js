$(document).ready(function(){
    
    $("#pw_change").submit(function (){
        
        var current_pw = $("#current_pw").val();
        var new_pw = $("#new_pw").val();
        var confirm_pw = $("#confirm_pw").val();
        
        if(current_pw=="")
        {
            $("#alertDiv").html("Current Password cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#current_pw").focus();
            return false;
        }
        if(new_pw=="")
        {
            $("#alertDiv").html("New Password cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#new_pw").focus();
            return false;
        }
        if(confirm_pw=="")
        {
            $("#alertDiv").html("Confirm Password cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#confirm_pw").focus();
            return false;
        }
        if(new_pw!=confirm_pw)
        {
            $("#alertDiv").html("New password and confirm password does not match!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#confirm_pw").focus();
            return false;
        }
        
    });
    
    
    
    
}); 