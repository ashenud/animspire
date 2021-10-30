<html>
    <head>
        <title>Home Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../css/home.css"/>
        <link rel='stylesheet' type="text/css" href="../bootstrap/css/mdb.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>      
        
    </head>
    
    <body  style="background-image: url('../images/background-image.png');">
        <div class="cont" style="background-image: url('../images/home-bg-final.png');">
            <div class="dropdown dropright" style="padding: 25px; font-family: 'Roboto', sans-serif;">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" style="width: 120px; height: auto; font-size: 20px; font-family: 'Nunito', sans-serif; "> Sign Up </button>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="customer/customer-signup.php">As a Customer</a>
                     <a class="dropdown-item" href="freelancer/freelancer-signup.php">As a Freelancer</a>
                  </div>
           </div>
            <div class="btn-row">
                <a type="button" href="user/user-login.php" class="btn btn-cyan" style="font-size:20px; color: white; padding: 8px 40px; margin: auto 50px auto 186px">Login</a>
                <a type="button" href="customer/customer-login.php" class="btn btn-purple" style="font-size:20px; color: white; padding: 8px 40px; margin: auto 50px auto 50px">Login</a>
                <a type="button" href="freelancer/freelancer-login.php" class="btn btn-danger" style="font-size:20px; color: white; padding: 8px 40px; margin: auto 50px auto 50px">Login</a>
            </div>
            <div class="image-text" style="padding-top: 75px">
                  <h3>Animspire Freelance Management System</h3>
              </div>
            </div>
       
        
        
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>  
    
    <!--Sign Up Dropdown -->
    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
            
