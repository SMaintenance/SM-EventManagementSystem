<?php
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];
$locId = $_GET['locId'];

$connection = Connection::getInstance();
$gateway = new EventTableGateway($connection);
$gateway1 = new LocationTableGateway($connection);

$statement = $gateway->getEventsById($id);
$locations = $gateway1->getLocations();
$statement1 = $gateway1->getLocationsById($locId);

$row = $statement->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    die("Illegal request");
}
$row1 = $statement1->fetch(PDO::FETCH_ASSOC);
if (!$row1) {
    die("Illegal request");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Event</title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
        <?php require 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class="content">
            <div class="container">
                <h1>Edit Event Form</h1><!--form title-->
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="editEvent.php" method="POST" class="form-horizontal">
                <input type="hidden" name="id" value="<?php echo $row['EventID']; ?>" />
                    <div class="form-group">
                        <label for="Title" class="col-md-2 control-label">Title</label><!--event title-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Title" name="Title" value="<?php echo $row['Title']; ?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="TitleError" class="error"><!--error message for invalid input-->
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Description" class="col-md-2 control-label">Description</label><!--event description-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Description" name="Description" value="<?php echo $row['Description']; ?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="DescriptionError" class="error"><!--error message for invalid input-->
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="StartDate" class="col-md-2 control-label">Start Date</label><!--start date-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="StartDate" name="StartDate" value="<?php echo $row['StartDate']; ?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="StartDateError" class="error"><!--error message for invalid input-->
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="EndDate" class="col-md-2 control-label">End Date</label><!--end date-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="EndDate" name="EndDate" value="<?php echo $row['EndDate']; ?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="EndDateError" class="error"><!--error message for invalid input-->
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Cost" class="col-md-2 control-label">Cost</label><!--cost-->
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="Cost" name="Cost" value="<?php echo $row['Cost']; ?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="CostError" class="error"><!--error message for invalid input-->
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LocID" class="col-md-2 control-label">Location ID</label><!--location id-->
                        <div class="col-md-5">
                            <select name="LocID" id="LocID" class="form-control">
                                <?php
                                    echo '<option value="'.$row['LocationID'].'" selected>'.$row1['Name'].'</option>';
                                    foreach ($locations as $location) {
                                        if ($location['LocationID'] == $row['LocationID']) {
                                            continue;
                                        } else {
                                            echo '<option value="'.$location['LocationID'].'">'.$location['Name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <span id="LocIDError" class="error"><!--error message for invalid input-->
                            </span>
                        </div>
                    </div>
                    <button type="submit" class = "btn btn-default pull-right">Update <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    <a class="btn btn-default navbar-btn" href = "viewEvents.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a><!--register button-->
                </form>
            </div>
        </div>
        <?php require 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
    </body>
</html>
