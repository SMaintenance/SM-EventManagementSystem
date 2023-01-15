<header class="bgImage">
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header"><!--website name/title-->
                <a href="index.php" class="navbar-brand">
                    Event Management Systems
                </a>
            </div>
            <ul class="nav navbar-nav navbar-right"><!--navigation-->
                

                <li><a href = "index.php">Home</a></li>
                <li><a href = "viewEvents.php">Events</a></li>
                <li><a href = "viewLocations.php">Locations</a></li>
                <li><a href = "viewBookings.php">Bookings</a></li>
                <li><a href = "contact.php">Contact Us</a></li>
                <li class="btnlogout"><a class = "btn btn-default navbar-btn" href = "logout.php">Logout <span class = "glyphicon glyphicon-log-out"></span></a></li>

                

                <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><!--modal for login-->
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header"><!--modal header-->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Login</h4><!--modal title-->
                            </div>
                            <div class="row">
                                <div class="modal-body"><!--modal content-->
                                    <div class="col-md-6 col-md-offset-3">
                                        <form action="login.php" method="POST">
                                            <div class="form-group"><!--username-->
                                                <label for="username">Username:</label>
                                                <input type="text" name="username" class="form-control" value="<?php if (isset($formdata['username'])) echo $formdata['username']; ?>" />
                                                <span class="error"><!--error message on failed input-->
                                                    <?php if (isset($errors['username'])) echo $errors['username']; ?>
                                                </span>
                                            </div>
                                            <div class="form-group"><!--password-->
                                                <label for="password">Password:</label>
                                                <input type="password" name="password" class="form-control" value="" />
                                                <span class="error"><!--error message on failed input-->
                                                    <?php if (isset($errors['password'])) echo $errors['password']; ?>
                                                </span>
                                            </div>
                                            <button type="submit" class="btn btn-default loginbtn">Login</button><!--login button-->
                                            <a class="btn btn-default navbar-btn rgsterbtn" href="register_form.php">Register</a><!--register button-->
                                        </form>
                                    </div>
                                </div><!--modal body div-->
                            </div><!--row div-->
                            <div class="modal-footer"><!--modal footer-->
                                <button type="button" class="btn btn-default closebtn" data-dismiss="modal">Close</button>
                                <p><!--close button-->
                            </div><!--modal footer div-->
                        </div><!--modal content div-->
                    </div><!--modal dialog div-->
                </div><!-- modal div -->
            </ul>
        </div><!--container div-->
    </nav>
    <div class="col-md-12">
        <div class="container">
            <div class="jumbotron"><!--jumbotron-->
                <h1>Urban Events Venues & Catering</h1><!--jumbotron heading-->
                <p><!--jumbotron content-->
                    Whether you're looking to book a cocktail party, post-work gathering, celebratory function, conference, business
                    meeting, wedding or private dining event, our dedicated Urban Events team can create a package that will meet
                    your every need.
                </p>
                <p id="dateAndTime"></p>
            </div>
        </div>
    </div>
</header>