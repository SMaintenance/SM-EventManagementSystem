<?php
require_once 'utils/checkLogin.php';
if (!isset($_GET['username'])) {
    die("Illegal request");
}
$username  = $_GET['username'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login Form</title>
        <style>
            span.error{
                color: red;
            }            
        </style>  
        <?php require_once 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require_once 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
    <?php require_once 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class = "content"><!--body content holder-->
            <div class = "container ">
                <h1 class="text-center">Reset Password</h1><!--form title-->
                <form action="resetPassword.php" method="POST"><!--form-->
                <br><br>
                <div class="container">
                    <input type="hidden" value="<?php if (isset($username)) { echo $username; } ?>" name="username">
                    <div class="form-inline text-center" style="padding-right:1.9cm;">
                        <div class = "form-group">
                            <label for="password" class="" style="width:7.3cm">Please enter your new password: </label>
                            <input type="password"name="password"class="form-control" value="<?php if (isset($formdata['password'])) { echo $formdata['password']; } ?>">
                        </div>
                    </div>
                    <br>
                    <div class="form-inline text-center">
                    <div class = "form-group">
                            <label for="password_confirmation" class="" style="width:7cm">Please re-enter your the password: </label>
                            <input type="password"name="password_confirmation"class="form-control" value="<?php if (isset($formdata['password_confirmation'])) { echo $formdata['password_confirmation']; } ?>">
                        </div>
                        <button type = "submit" class = "btn btn-primary">Save</button>
                    </div>
                    
                    <div class="text-center" style="padding-left:4cm">
                        <span class = "error"><!--error message for invalid input-->
                            <?php if (isset($errors['password'])) echo $errors['password']; ?>
                            <?php if (isset($errors['password_confirmation'])) echo $errors['password_confirmation']; ?>
                        </span>
                    </div>
                    
                </div>
                        
                    </form>
            </div><!--container div-->
        </div><!--content div-->
        <?php require_once 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
    </body>
</html>
