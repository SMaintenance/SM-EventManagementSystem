<?php
require_once 'functions.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';

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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Event Form</title>
    <?php require_once 'utils/styles.php'; ?>
    <!--css links. file found in utils folder-->
    <?php require_once 'utils/scripts.php'; ?>
    <!--js links. file found in utils folder-->
</head>

<body>
    <?php require_once 'utils/header.php'; ?>
    <!--header content. file found in utils folder-->
    <div class="content">
        <div class="container" style="width: 50%">
            <h1 style="text-align: center">Create Event Form</h1>
            <!--form title-->
            <br>
            <?php
            if (isset($errorMessage)) {
                echo '<p>Error: ' . $errorMessage . '</p>';
            }
            ?>
            <form action="createEvent.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="Title" class="control-label">Title</label>
                    </div>
                    <!--event title-->
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="Title" name="Title"
                            value="<?php echoValue($formdata, "Title") ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px">
                        <span id="TitleError" class="error">
                            <!--error message for invalid input-->
                            <?php echoValue($errors, 'Title'); ?>
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="Description" class="control-label">Description</label>
                    </div>
                    <!--event description-->
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="Description" name="Description"
                            value="<?php echoValue($formdata, "Description") ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px">
                        <span id="DescriptionError" class="error">
                            <!--error message for invalid input-->
                            <?php echoValue($errors, 'Description'); ?>
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label class="control-label">Event Type</label>
                    </div>
                    <!--event type-->
                    <div class="col-md-9">
                        <input type="radio" name="eType" value=1 <?php echoChecked($formdata, "eType", 1); ?>> Wedding
                        <br>
                        <input type="radio" name="eType" value=2 <?php echoChecked($formdata, "eType", 2); ?>> Birthday
                        <br>
                        <input type="radio" name="eType" value=3 <?php echoChecked($formdata, "eType", 3); ?>> Fashion
                        <br>
                        <input type="radio" name="eType" value=4 <?php echoChecked($formdata, "eType", 4); ?>> Meeting
                        <br>
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px">
                        <span id="typeError" class="error">
                            <?php echoValue($errors, 'eType'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="StartDate" class="control-label">Start Date</label>
                    </div>
                    <!--start date-->
                    <div class="col-md-9">
                        <input type="date" class="form-control" id="StartDate" name="StartDate"
                            value="<?php echoValue($formdata, "StartDate") ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px">
                        <span id="StartDateError" class="error">
                            <!--error message for invalid input-->
                            <?php echoValue($errors, 'StartDate'); ?>
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="EndDate" class="control-label">End Date</label>
                    </div>
                    <!--end date-->
                    <div class="col-md-9">
                        <input type="date" class="form-control" id="EndDate" name="EndDate"
                            value="<?php echoValue($formdata, "EndDate") ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px">
                        <span id="EndDateError" class="error">
                            <!--error message for invalid input-->
                            <?php echoValue($errors, 'EndDate'); ?>
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="Cost" class="control-label">Cost</label>
                    </div>
                    <!--cost-->
                    <div class="col-md-9">
                        <input type="number" class="form-control" id="Cost" name="Cost"
                            value="<?php echoValue($formdata, "Cost") ?>" />
                        <!--input-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px">
                        <span id="CostError" class="error">
                            <!--error message for invalid input-->
                            <?php echoValue($errors, 'Cost'); ?>
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="LocID" class="control-label">Location ID</label>
                    </div>
                    <!--location id-->
                    <div class="col-md-9">
                        <select name="LocID" id="LocID" class="form-control">
                            <?php
                            foreach ($locations as $location) {
                                echo '<option value="' . $location['LocationID'] . '">' . $location['Name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px">
                        <span id="LocIDError" class="error">
                            <!--error message for invalid input-->
                            <?php echoValue($errors, 'LocID'); ?>
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label class="control-label">Attach Event Image</label>
                    </div>
                    <div class="col-md-9">
                        <img src="uploads/<?php echo "noImage.png" ?>" style="width: 100%; height: auto" id="image">
                        <input type="file" id="imageUploaded" class="control-label" name="image" style="display: none;">
                        <label class="btn btn-default" style="margin-top: 3%;" for="imageUploaded">
                            Choose file
                        </label>
                    </div>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-default pull-right submit">Create Event <span
                        class="glyphicon glyphicon-send"></span></button>
                <a class="btn btn-default navbar-btn" href="viewEvents.php"><span
                        class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                <!--register button-->
            </form>
        </div>
    </div>
    <?php require 'utils/footer.php'; ?>
    <!--footer content. file found in utils folder-->
    <script type="text/javascript">
        document.getElementById('imageUploaded').onchange = function () {
            document.getElementById('image').src = URL.createObjectURL(imageUploaded.files[0]);
        }
    </script>
</body>
</html>
