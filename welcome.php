<?php 

    //Initialise the session
    session_start();

    //Check if user is logedin, not not then user is redirected to the login page
    if(!isset($_SESSION["id"]) || !isset($_SESSION["username"])){
        header("location: login.php");
        exit();
    }


?>

<?php include('./components/header.php') ?>
<body>

    

    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            
            <div class="col-sm-4"></div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 login-wrapper">
                <h3 class="center-text">Welcome back  <b><i><?php echo htmlspecialchars($_SESSION["username"])  ?></i></b></h3><br><br>
                <p></i></b></p>
                <div class="col-sm-12">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-5">
                        <a href="reset.php" class="btn btn-success fill-available">RESET</a>
                    </div>
                    <div class="col-sm-5">
                        <a href="logout.php" class="btn btn-danger fill-available">LOGOUT</a>
                    </div>
                    <div class="col-sm-1"></div>                    
                </div> 
            </div> 
            <div class="col-sm-4"></div>
        </div>       
    </div>  
</body>
</html>