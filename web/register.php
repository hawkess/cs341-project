<?php
if(session_status() === PHP_SESSION_NONE) session_start();
require_once "cms.php";

$results = array();
$results['pageTitle'] = "CSE 341 CMS Register";
 
$username = "";
$password = "";
$confirm_password = "";
$username_err = "";
$password_err = "";
$confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter a username.";
    } 
    else 
    {   
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT id FROM users WHERE username = :username";     
        
        if($stmt = $conn->prepare($sql))
        {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);            
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute())
            {
                if($stmt->rowCount() == 1)
                {
                    $username_err = "This username is already taken.";
                } 
                else
                {
                    $username = trim($_POST["username"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
        unset($conn);
    }
    
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";     
    }
    elseif(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have atleast 6 characters.";
    } 
    else
    {
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";     
    } 
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {        
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $conn->prepare($sql))
        {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if($stmt->execute())
            {
                header("location: admin.php?action=login");
            } 
            else
            {
                echo "Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
        unset($conn);
    } 
}
?>
<?php include "include/header.php" ?>
<body>
   <?php include "include/navbar.php" ?>
    <div class="container-fluid">
       <div class="w-25 m-auto py-5">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
                <p>Already have an account? <a href="admin.php?action=login">Login here</a>.</p>
            </form>
        </div>
    </div>    
</body>
</html>