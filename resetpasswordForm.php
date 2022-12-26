<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login Form</title>
        <style>
            span.error{
                color: red;
            }            
        </style>  
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
    <?php require 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class = "content"><!--body content holder-->
            <div class = "container ">
                <h1 class="text-center">Reset Password</h1><!--form title-->
                <form action="resetPassword.php" method="POST"><!--form-->
                <br><br>
                <div class="container" style="padding-left:20%">

                    <div class="form-inline ">
                        <div class = "form-group">
                            <!--username field-->
                            <label for="username" class="" style="width:10cm">Please enter your username again: </label>
                            <input type="text"
                                    name="username"class="form-control"value="<?php if (isset($formdata['username'])) echo $formdata['username']; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="form-inline ">
                        <div class = "form-group">
                            <!--username field-->
                            <label for="password" class="" style="width:10cm">Please enter your new password: </label>
                            <input type="text"name="password"class="form-control" value="<?php if (isset($formdata['password'])) echo $formdata['password']; ?>">
                        </div>
                        <button type = "submit" class = "btn btn-primary">Save</button>
                    </div>
                    <div class="text-center" style="padding-left:4cm">
                        <span class = "error"><!--error message for invalid input-->
                            <?php if (isset($errors['password'])) echo $errors['password']; ?>
                        </span>
                    </div>
                    
                </div>
                        
                    </form>
            </div><!--container div-->
        </div><!--content div-->
        <?php require 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
    </body>
</html>