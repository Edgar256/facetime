<?php 

    //Initialise the session
    session_start();    

    //Check if user is logedin, not not then user is redirected to the login page
    if(!isset($_SESSION["id"]) || !isset($_SESSION["username"])){
        header("location: login.php");
        exit();
    }

    //print username for this session
    // echo $_SESSION["username"];

?>

<?php include('header.php') ?>
    <body>   
        <div class="container">
        
            <div class="col-sm-2">
                <?php include('./menu.php') ?>
            </div>
            <div class="col-sm-7">
                <p><?php echo $_SESSION["username"]; ?>'s post  will go here</p>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </body>
</html>