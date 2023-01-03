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
    <?php require 'utils/styles.php'; ?>
    <!--css links. file found in utils folder-->
    <?php require 'utils/scripts.php'; ?>
    <!--js links. file found in utils folder-->
</head>

<body>
    <?php require 'utils/header.php'; ?>
    <!--header content. file found in utils folder-->
    <div class="content">
        <div class="container" style="width:50%">
            <h1 style="text-align:center">Edit Event Form</h1>
            <!--form title-->
            <?php
            if (isset($errorMessage)) {
                echo '<p>Error: ' . $errorMessage . '</p>';
            }
            ?>
            <form action="editEvent.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['EventID']; ?>" />
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="Title" class="control-label">Title</label>
                        <!--event title-->
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="Title" name="Title" value="<?php echo $row['Title']; ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left:15px">
                        <span id="TitleError" class="error">
                            <!--error message for invalid input-->
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="Description" class="control-label">Description</label>
                        <!--event description-->
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="Description" name="Description" value="<?php echo $row['Description']; ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left:15px">
                        <span id="DescriptionError" class="error">
                            <!--error message for invalid input-->
                        </span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="EventType" class="control-label">Event Type</label>
                        <!--event type-->
                    </div>
                    <div class="col-md-9">
                        <?php $eType = $row['EventType']; ?>
                        <input type="radio" name="eType" value=1 <?php echo ($eType == 1) ?  "checked" : "";  ?>> Wedding <br>
                        <input type="radio" name="eType" value=2 <?php echo ($eType == 2) ?  "checked" : "";  ?>> Birthday <br>
                        <input type="radio" name="eType" value=3 <?php echo ($eType == 3) ?  "checked" : "";  ?>> Fashion <br>
                        <input type="radio" name="eType" value=4 <?php echo ($eType == 4) ?  "checked" : "";  ?>> Meeting <br>
                    </div>
                    <div class="col-md-offset-3" style="padding-left:15px">
                        <span id="EventTypeError" class="error">
                            <!--error message for invalid input-->
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="StartDate" class="control-label">Start Date</label>
                        <!--start date-->
                    </div>
                    <div class="col-md-9">
                        <input type="date" class="form-control" id="StartDate" name="StartDate" value="<?php echo $row['StartDate']; ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left:15px">
                        <span id="StartDateError" class="error">
                            <!--error message for invalid input-->
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="EndDate" class="control-label">End Date</label>
                        <!--end date-->
                    </div>
                    <div class="col-md-9">
                        <input type="date" class="form-control" id="EndDate" name="EndDate" value="<?php echo $row['EndDate']; ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left:15px">
                        <span id="EndDateError" class="error">
                            <!--error message for invalid input-->
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="Cost" class="control-label">Cost</label>
                        <!--cost-->
                    </div>
                    <div class="col-md-9">
                        <input type="number" class="form-control" id="Cost" name="Cost" value="<?php echo $row['Cost']; ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left:15px">
                        <span id="CostError" class="error">
                            <!--error message for invalid input-->
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="LocID" class="control-label">Location</label>
                        <!--location id-->
                    </div>
                    <div class="col-md-9">
                        <select name="LocID" id="LocID" class="form-control">
                            <?php
                            echo '<option value="' . $row['LocationID'] . '" selected>' . $row1['Name'] . '</option>';
                            foreach ($locations as $location) {
                                if ($location['LocationID'] == $row['LocationID']) {
                                    continue;
                                } else {
                                    echo '<option value="' . $location['LocationID'] . '">' . $location['Name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-offset-3" style="padding-left:15px">
                        <span id="LocIDError" class="error">
                            <!--error message for invalid input-->
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label class="control-label">Attach Event Image</label>
                    </div>
                    <div class="col-md-9">
                        <img src="uploads/<?php echo $row['Image'] ?>" style="width: 100%; height: auto" id="image">
                        <input type="hidden" class="control-label" name="old_image" value="<?php echo $row['Image'] ?>">
                        <input type="file" id="imageUploaded" class="control-label" name="image" style="display: none;">
                        <label class="btn btn-default" style="margin-top: 2%;" for="imageUploaded">
                            Choose file
                        </label>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-default pull-right">Update <span class="glyphicon glyphicon-floppy-disk"></span></button>
                <a class="btn btn-default navbar-btn" href="viewEvents.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                <!--register button-->

            </form>
        </div>
    </div>
    <?php require 'utils/footer.php'; ?>
    <!--footer content. file found in utils folder-->
    <script type="text/javascript">
        document.getElementById('imageUploaded').onchange = function() {
            document.getElementById('image').src = URL.createObjectURL(imageUploaded.files[0]);
        }
    </script>
</body>

</html>