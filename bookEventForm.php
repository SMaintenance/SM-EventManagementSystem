<?php
require_once 'functions.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';
require_once 'utils/checkLogin.php';

$connection = Connection::getInstance();
$gateway = new LocationTableGateway($connection);

$locations = $gateway->getLocations();

if (!isset($formdata)) {
    $formdata = array();
}

if (!isset($errors)) {
    $errors = array();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Book Event Form</title> 
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
        <?php require 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class = "content">
            <div class = "container" style="width:50%">
                <h1 style="text-align:center">Book Event Form</h1><!--form title-->
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="bookEvent.php" method="POST">
                    <hr>
                    <h4>Customer's Information</h4>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Name" class="control-label">Full Name</label><!--event title-->
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="Name" name="Name" value="<?php echoValue($formdata, "Name")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="NameError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'Name');?>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Email" class="control-label">Email</label><!--event title-->
                        </div>
                        <div class="col-md-9">
                            <input type="email" class="form-control" id="Email" name="Email" value="<?php echoValue($formdata, "Email")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="EmailError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'Email');?>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="ContactNum" class="control-label">Contact Number</label><!--event title-->
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="ContactNum" name="ContactNum" value="<?php echoValue($formdata, "ContactNum")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="ContactNumError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'ContactNum');?>
                            </span>
                        </div>
                    </div>

                    <hr>
                    <h4>Booking's Information</h4>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Title" class="control-label">Title</label><!--event title-->
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="Title" name="Title" value="<?php echoValue($formdata, "Title")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="TitleError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'Title');?>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Description" class=" control-label">Description</label><!--event description-->
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="Description" name="Description" value="<?php echoValue($formdata, "Description")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="DescriptionError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'Description');?>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="EventType" class="control-label">Event Type</label><!--event type-->
                        </div>
                        <div class="col-md-9">
                            <input type="radio" name="EventType" value=1 <?php echoChecked($formdata, "EventType", 1); ?>>  Wedding <br>
                            <input type="radio"  name="EventType" value=2 <?php echoChecked($formdata, "EventType", 2); ?>>  Birthday <br>
                            <input type="radio" name="EventType" value=3 <?php echoChecked($formdata, "EventType", 3); ?>>  Fashion <br>
                            <input type="radio"  name="EventType" value=4 <?php echoChecked($formdata, "EventType", 4); ?>>  Meeting <br>
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="EventTypeError" class="error">
                                <?php echoValue($errors, 'EventType'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="StartDate" class="control-label">Start Date</label><!--start date-->
                        </div>
                        <div class="col-md-9">
                            <input type="date" class="form-control" id="StartDate" name="StartDate" value="<?php echoValue($formdata, "StartDate")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="StartDateError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'StartDate');?>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="EndDate" class="control-label">End Date</label><!--end date-->
                        </div>
                        <div class="col-md-9">
                            <input type="date" class="form-control" id="EndDate" name="EndDate" value="<?php echoValue($formdata, "EndDate")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="EndDateError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'EndDate');?>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Location" class="control-label">Location</label><!--location id-->
                        </div>
                        <div class="col-md-9">
                            <select name="Location"
                                        id="Location"
                                        class="form-control"
                                        >
                                    <?php
                                    foreach ($locations as $location) {
                                        echo '<option value="'.$location['LocationID'].'">'.$location['Name'].'</option>';
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="LocationError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'Location');?>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class = "btn btn-default pull-right submit">Book Event <span class="glyphicon glyphicon-send"></span></button>
                    <a class="btn btn-default navbar-btn" href = "index.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a><!--register button-->
                </form>
            </div>
        </div>
        <?php require 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
    </body>
</html>
