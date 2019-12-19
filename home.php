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

<?php include('./components/header.php') ?>
    <body>   
        <div class="container">
        
            <div class="col-sm-2">
                <?php include('././components/menu.php') ?>
            </div>
            <div class="col-sm-7">
                <?php include("./components/create-post.php") ?>
                
                <?php include("././components/user-post.php") ?>
                <?php include("././components/user-post.php") ?>
                <?php include("././components/user-post.php") ?>
                <?php include("././components/user-post.php") ?>
                <?php include("././components/user-post.php") ?>
                <?php include("././components/user-post.php") ?>
                <?php include("././components/user-post.php") ?>
                <?php include("././components/user-post.php") ?>

            </div>
            <div class="col-sm-3">
                <?php include("my-page.php") ?>
                <div>People you may know</div>
            </div>
        </div>
    </body>
</html>