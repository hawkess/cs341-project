<?php
if(session_status() === PHP_SESSION_NONE) session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: admin.php?action=login");
    exit;
}
require_once "cms.php";
 
$new_password = "";
$confirm_password = "";
$new_password_err = "";
$confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["new_password"])))
    {
        $new_password_err = "Please enter the new password.";     
    } 
    elseif(strlen(trim($_POST["new_password"])) < 6)
    {
        $new_password_err = "Password must have at least 6 characters.";
    } 
    else
    {
        $new_password = trim($_POST["new_password"]);
    }
    
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm the password.";
    } else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }
        
    if(empty($new_password_err) && empty($confirm_password_err))
    {
        $param_password = password_hash($new_password, PASSWORD_DEFAULT);
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        if($stmt = $conn->prepare($sql)){
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $_SESSION["user_id"], PDO::PARAM_INT);
            
            if($stmt->execute())
            {
                session_destroy();
                header("location: admin.php?action=login");
                exit();
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    unset($conn);
}
?> 
<?php include "include/header.php" ?>
<body>
   <?php include "include/navbar.php" ?>
    <div class="container-fluid">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?> autofocus">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-dark" value="Submit">
                <a class="btn btn-link" href="index.php?action=homepage">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>