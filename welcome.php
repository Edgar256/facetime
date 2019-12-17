<?php 

    //Initialise the session
    session_start();

    //Check if user is logedin, not not then user is redirected to the login page
    if(!isset($_SESSION["id"]) || !isset($_SESSION["username"])){
        header("location: login.php");
        exit();
    }


?>



<!DOCTYPE html>
<html>
<head>
	<title>FACETIME APP</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>
<body>

    

    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"><h3>Please login here</h3></div>
            <div class="col-sm-4"></div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <p>Welcome back  <b><i><?php echo htmlspecialchars($_SESSION["username"])  ?></i></b></p>
                <div class="col-sm-12">
                    <a href="reset.php" class="btn btn-success">RESET PASSWORD</a>
                    <a href="logout.php" class="btn btn-danger">LOGOUT</a>
                </div> 
            </div> 
            <div class="col-sm-4"></div>
        </div>       
    </div>  
</body>
</html>