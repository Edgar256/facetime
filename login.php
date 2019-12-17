<?php 

    //Initialise the session
    session_start();

    //Check if the user is already logged in, if yes then redirect hi to the welcome page
    if(isset($_SESSION["id"]) && $_SESSION["username"] === true){
        header("location: welcome.php");
        exit;
    }

    //incclude config file
    require_once "config.php";

    //Define variables and initialise with empty values
    $username = $password = "";
    $username_err = $password_err = "";

    //Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please submit username";
        }else{
            $username = trim($_POST["username"]);
        }

        //Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password = "Please submit password";
        }else{
            $password = trim($_POST["password"]);
        }

        //Validate Credentials
        if(empty($username_err) && empty($password_err)){

            //Prepare a select statement

            $sql = "SELECT id, username, password FROM users WHERE username = ?";

        }

        global $sql;

        if($stmt = $mysqli->prepare($sql)){

            //Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            //Set parameters
            $param_username = $username;

            //Attempt to execute the prepared statement
            if($stmt->execute()){

                //Store the result
                $stmt->store_result();

                //Check if username exists
                if($stmt->num_rows ==1){

                    //Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            
                            //pasword is correct so start session
                            //session_start();

                            //Store data in session varaibles
                            //$SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            //Redirect to the welcome page
                            header("location: welcome.php");
                        }else{

                            //Display an error message if password is not valid
                            $password_err = "The password you entered is not valid";

                        }
                    }

                }else{

                    //Display error message if username doesnot exist
                    $username_err = "No account found with that username";

                }

            }else{
                echo "Oops! Something went wrong. Please try again later.";
            }

        }

        //Close Statement
        //$stmt->close();

    }


?>


<?php include 'header.php' ?>

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
                    
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" class="form-control"  placeholder="Enter email or username" name="username" value="<?php echo $username; ?>">
                        <span class="help"><?php echo $username_err; ?></span>
                    </div>
                    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label for="">Password</label>
                        <input type="password" class="form-control"  placeholder="Password" name="password" value="<?php echo $password; ?>">
                        <span class="help"><?php echo $password_err; ?></span>
                    </div>
                                  
                    <input type="submit" class="btn btn-primary" value="Login">
                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </form>
            </div> 
            <div class="col-sm-4"></div>
        </div>       
    </div>  
</body>
</html>