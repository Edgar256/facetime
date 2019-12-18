<?php

    // //Initialise the session    

    // Include config file
    require_once "config.php";
    
    // Define variables and initialize with empty values
    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";    
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        // Validate username
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";
            
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_username);
                
                // Set parameters
                $param_username = trim($_POST["username"]);
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // store result
                    $stmt->store_result();
                    
                    if($stmt->num_rows == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            $stmt->close();
        }
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("ss", $param_username, $param_password);
                
                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Redirect to login page
                    header("location: login.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            $stmt->close();
        }
        
        // Close connection
        $mysqli->close();
    }
?>

<?php include 'header.php' ?>

<body>

    

    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 login-wrapper">
                <div class="col-sm-6 login-left">
                    <h2>Welcome to Facetime</h2>
                    <h4>Connect. Interact. Live</h4>
                </div>
                <div class="col-sm-6">
                    <h3>Please register here</h3>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has error' : ''; ?>">
                            <label for="">Username or Email address</label>
                            <input type="text" class="form-control" id="" placeholder="Enter email or username" name="username" value="<?php echo $username; ?>">
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            <span class="help"><?php echo $username_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($password_err)) ? 'has error' : ''; ?>">
                            <label for="">Password</label>
                            <input type="password" class="form-control" id="" placeholder="Password" value="<?php echo $password ?>" name="password">
                            <span class="help"><?php echo $username_err; ?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($confirm_password)) ? 'has error' : ''; ?>">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" id="" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>" name="confirm_password">
                            <span class="help"><?php echo $confirm_password_err; ?></span>
                        </div>
                        
                        <!-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </form>
                </div>
            </div> 
            <div class="col-sm-2"></div>
        </div>       
    </div>  
</body>
</html>