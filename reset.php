<?php 

    //initialise session
    session_start();

    //Check if user is logged in, if not then redirect to the login page
    if(!isset($_SESSION["id"])  || !isset($_SESSION["username"])){
        header("location: login.php");
        exit();
    }

    //include config file
    require_once "config.php";

    //Define variables and initialise with empty values
    $new_password = $confirm_password = "";
    $new_password_err = $confirm_password_err = "";

    //Processinf form data when form is submitted
    // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}

?>

<?php include('header.php') ?>

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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" METHOD="post">
                    <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" class="form-control" id="" placeholder="Enter email or username" name="username" value="<?php echo $new_password; ?>">                        
                    </div>
                    <div class="form-group"><?php echo $new_password_err; ?></div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <div class="form-group">
                        <label for="">Confirm New Password</label>
                        <input type="password" class="form-control" id="" placeholder="Password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                    </div>
                    <div class="form-group"><?php echo $confirm_password_err; ?></div>              
                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div> 
            <div class="col-sm-4"></div>
        </div>       
    </div>  
</body>
</html>