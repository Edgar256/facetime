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
                <div class="menu-tile">
                    <img src="./assets/images/face002.jpg" class="profile-image-wrap">
                    <?php echo $_SESSION["username"]; ?>
                </div>
                <div class="menu-tile">
                    <i class="fa fa-newspaper"></i>
                    News Feed
                </div>
                <div class="menu-tile">
                    <i class="fa fa-user-friends"></i>
                    Friends
                </div>
                <div class="menu-tile">
                    <i class="fa fa-envelope"></i>
                    Messenger
                </div>
                <div class="menu-tile">
                    <i class="fa fa-video"></i>
                    Videos on Watch
                </div>
                <div class="menu-tile">
                    <i class="fa fa-users"></i>
                    Groups
                </div>
                <div class="menu-tile">
                    <i class="fa fa-layer-group"></i>
                    Pages
                </div>
                <div class="menu-tile">
                    <i class="fa fa-calendar-week"></i>
                    Events
                </div>
                <div class="menu-tile">
                    <i class="fa fa-smog"></i>
                    Weather
                </div>
                <div class="menu-tile">
                    <i class="fa fa-briefcase"></i>
                    Jobs
                </div>
                <div class="menu-tile">
                    <i class="fa fa-list"></i>
                    Friend Lists
                </div>
                <div class="menu-tile">
                    <i class="fa fa-chart-line"></i>
                    Recent Activity
                </div>
            </div>
            <div class="col-sm-7">
                <p><?php echo $_SESSION["username"]; ?>'s post  will go here</p>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </body>
</html>