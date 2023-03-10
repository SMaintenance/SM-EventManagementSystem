<?php
require_once 'utils/checkLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Contact</title>
        <?php require_once 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require_once 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
        <?php require_once 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class = "content"><!--body content holder-->
        <div class = "container">
            <div class = "col-md-12"><!--body content title holder with 12 grid columns-->
                    <h1>Contact Us</h1><!--body content title-->
                </div>
            </div>
			
            <div class="container">
            <div class="col-md-12">
            <hr>
            </div>
            </div>
            
            <div class="container">
                <div class="col-md-6 contacts">
                    <h1><span class="glyphicon glyphicon-user"></span> Jullian Engracio</h1>
                    <p>
                        <span class="glyphicon glyphicon-envelope"></span>
                        <a href="mailto:julzengracio@gmail.com"> Email: julzengracio@gmail.com</a>
                        <br>
                        <span class="glyphicon glyphicon-link"></span>
                        <a href="https://www.facebook.com/TaylorSwift/"> Facebook: www.facebook.com/julzengracio</a>
                        <br>
                    </p>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="Title">Title:</label>
                            <input type="text" name="title" id="Title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Message:</label>
                            <textarea id="Comment" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default pull-right">Send
                            <span class="glyphicon glyphicon-send"></span>
                        </button>
                    </form>
                </div>
            </div>
            
        </div><!--body content div-->
        <?php require_once 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
    </body>
</html>
