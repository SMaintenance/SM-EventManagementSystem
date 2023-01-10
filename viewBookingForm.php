<?php
require_once 'functions.php';
require_once 'classes/Booking.php';
require_once 'classes/BookingTableGateway.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new BookingTableGateway($connection);
$gateway1 = new LocationTableGateway($connection);

$statement = $gateway->getBookingsById($id);
$locations = $gateway1->getLocations();

$row = $statement->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    die("Illegal request");
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
                <form action="bookEvent.php" method="POST">
                    <hr>
                    <h4>Customer's Information</h4>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Name" class="control-label">Full Name</label><!--event title-->
                        </div>
                        <div class="col-md-9">
                            <input readonly type="text" class="form-control" id="Name" name="Name" value="<?php echo $row['FullName']; ?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Email" class="control-label">Email</label><!--event title-->
                        </div>
                        <div class="col-md-9">
                            <input readonly type="email" class="form-control" id="Email" name="Email" value="<?php echo $row['Email'];?>" /><!--input-->
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="ContactNum" class="control-label">Contact Number</label><!--event title-->
                        </div>
                        <div class="col-md-9">
                            <input readonly type="number" class="form-control" id="ContactNum" name="ContactNum" value="<?php echo $row['ContactNum'];?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                        </div>
                    </div>

                    <hr>
                    <h4>Booking's Information</h4>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Title" class="control-label">Title</label><!--event title-->
                        </div>
                        <div class="col-md-9">
                            <input readonly type="text" class="form-control" id="Title" name="Title" value="<?php echo $row['Title'];?>" /><!--input-->
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Description" class=" control-label">Description</label><!--event description-->
                        </div>
                        <div class="col-md-9">
                            <input readonly type="text" class="form-control" id="Description" name="Description" value="<?php echo $row['Description'];?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="EventType" class="control-label">Event Type</label><!--event type-->
                        </div>
                        <div class="col-md-9">
                            <input readonly type="radio" name="EventType" value=1 <?php echoChecked($row, "EventType", 1); ?>>  Wedding <br>
                            <input readonly type="radio"  name="EventType" value=2 <?php echoChecked($row, "EventType", 2); ?>>  Birthday <br>
                            <input readonly type="radio" name="EventType" value=3 <?php echoChecked($row, "EventType", 3); ?>>  Fashion <br>
                            <input readonly type="radio"  name="EventType" value=4 <?php echoChecked($row, "EventType", 4); ?>>  Meeting <br>
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="StartDate" class="control-label">Start Date</label><!--start date-->
                        </div>
                        <div class="col-md-9">
                            <input readonly type="date" class="form-control" id="StartDate" name="StartDate" value="<?php echo $row['StartDate'];?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="EndDate" class="control-label">End Date</label><!--end date-->
                        </div>
                        <div class="col-md-9">
                            <input readonly type="date" class="form-control" id="EndDate" name="EndDate" value="<?php echo $row['EndDate'];?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Location" class="control-label">Location</label><!--location id-->
                        </div>
                        <div class="col-md-9">
                            <select readonly name="Location" id="Location" class="form-control">
                                <option readonly value=<?php echo $row['LocationID'];?>><?php echo $row['Name'];?></option>
                                </select>
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                        </div>
                    </div>
                    <a class="btn btn-default navbar-btn" href = "viewBookings.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a><!--register button-->
                </form>
            </div>
        </div>
        <?php require 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
    </body>
</html>
