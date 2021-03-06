<?php
if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: welcome.php");
    exit;
}
require_once "cms.php";

$results['pageTitle'] = "CSE 341 CMS Login";
 
$username = "";
$password = "";
$username_err = "";
$password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter username.";
    } 
    else
    {
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter your password.";
    } 
    else
    {
        $password = trim($_POST["password"]);
    }    
    if(empty($username_err) && empty($password_err))
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $conn->prepare($sql))
        {
            $param_username = trim($_POST["username"]);
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);         
            
            if($stmt->execute())
            {
                if($stmt->rowCount() == 1)
                {
                    if($row = $stmt->fetch())
                    {
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password))
                        {
                            if(session_status() === PHP_SESSION_NONE) session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $id;
                            $_SESSION["username"] = $username;                            
                            header("location: index.php?action=welcome");
                        } 
                        else
                        {
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } 
                else
                {
                    $username_err = "No account found with that username.";
                }
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
       <div class="w-25 m-auto py-5">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" autofocus>
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-dark" value="Login">
                </div>
                <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            </form>
        </div>
    </div>
</body>
</html>