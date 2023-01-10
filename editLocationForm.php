<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';
require_once 'functions.php';

$id = $_GET['id'];
if (!isset($_GET['id'])) {
    die("Illegal request");
}

$connection = Connection::getInstance();
$gateway = new LocationTableGateway($connection);

$statement = $gateway->getLocationsById($id);
$statement1 = $gateway->getFacilitiesById($id);

$row = $statement->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    die("Illegal request");
}

$row1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
if (!$row1) {
    die("Illegal request");
}

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
    <title>Edit Location</title>
    <?php require 'utils/styles.php'; ?>
    <!--css links. file found in utils folder-->
    <?php require 'utils/scripts.php'; ?>
    <!--js links. file found in utils folder-->
</head>

<body>
    <?php require 'utils/header.php'; ?>
    <!--header content. file found in utils folder-->
    <div class="content">
        <div class="container" style="width: 50%;">
            <h1 style="text-align: center;">Edit Location Form</h1>
            <!--form title-->
            <br>
            <?php
            if (isset($errorMessage)) {
                echo '<p>Error: ' . $errorMessage . '</p>';
            }
            ?>
            <form action="editLocation.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div style="margin-left: 25%">
                    <input type="hidden" name="id" value="<?php echo $row['LocationID']; ?>" />
                    <!--location id. auto incremented in database. cannot be updated from website-->
                    <div class="form-group">
                        <label for="Name" class="col-md-2 control-label">Name</label>
                        <!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Name" name="Name" value="<?php echo (isset($formdata['Name'])) ? ($formdata['Name']) :  $row['Name']; ?>" />
                            <!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="LNameError" class="error">
                                <?php echoValue($errors, 'Name'); ?>
                            </span>
                            <!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Address" class="col-md-2 control-label">Address</label>
                        <!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Address" name="Address" value="<?php echo (isset($formdata['Address'])) ? ($formdata['Address']) :  $row['Address'];  ?>" />
                            <!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="LAddressError" class="error">
                                <?php echoValue($errors, 'Address'); ?>
                            </span>
                            <!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ManagerFName" class="col-md-2 control-label">Manager First Name</label>
                        <!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="ManagerFName" name="ManagerFName" value="<?php echo (isset($formdata['ManagerFName'])) ? ($formdata['ManagerFName']) : $row['ManagerFName']; ?>" />
                            <!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="mNameError" class="error">
                                <?php echoValue($errors, 'ManagerFName'); ?>
                            </span>
                            <!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ManagerLName" class="col-md-2 control-label">Manager Last Name</label>
                        <!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="ManagerLName" name="ManagerLName" value="<?php echo (isset($formdata['ManagerLName'])) ? ($formdata['ManagerLName']) : $row['ManagerLName']; ?>" />
                            <!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="mNameError" class="error">
                                <?php echoValue($errors, 'ManagerLName'); ?>
                            </span>
                            <!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ManagerEmail" class="col-md-2 control-label">Manager Email</label>
                        <!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="ManagerEmail" name="ManagerEmail" value="<?php echo (isset($formdata['ManagerEmail'])) ? ($formdata['ManagerEmail']) : $row['ManagerEmail']; ?>" />
                            <!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="mEmailError" class="error">
                                <?php echoValue($errors, 'ManagerEmail'); ?>
                            </span>
                            <!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ManagerNumber" class="col-md-2 control-label">Manager Number</label>
                        <!--label-->
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="ManagerNumber" name="ManagerNumber" value="<?php echo (isset($formdata['ManagerNumber'])) ? ($formdata['ManagerNumber']) : $row['ManagerNumber']; ?>" />
                            <!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="mNumError" class="error">
                                <?php echoValue($errors, 'ManagerNumber'); ?>
                            </span>
                            <!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="MaxCapacity" class="col-md-2 control-label">Max Capacity</label>
                        <!--label-->
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="MaxCapacity" name="MaxCapacity" value="<?php echo (isset($formdata['MaxCapacity'])) ? ($formdata['MaxCapacity']) : $row['MaxCapacity']; ?>" />
                            <!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="capError" class="error">
                                <?php echoValue($errors, 'MaxCapacity'); ?>
                            </span>
                            <!--error message for invalid input-->
                        </div>
                    </div>
                    <!--codes below has no connection with the database.-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Location
                            Type</label>
                        <!--radio buttons with multiple options-->
                        <div class="col-md-5">
                            <?php $lType = (isset($formdata['LocationType'])) ? ($formdata['LocationType']) : $row['LocationType']; ?>
                            <input type="radio" name="LocationType" value=1 <?php echo ($lType == 1) ?  "checked" : "";  ?>> Indoor <br>
                            <input type="radio" name="LocationType" value=2 <?php echo ($lType == 2) ?  "checked" : "";  ?>> Outdoor <br>
                            <input type="radio" name="LocationType" value=3 <?php echo ($lType == 3) ?  "checked" : "";  ?>> Both
                        </div>
                        <div class="col-md-4">
                            <span id="typeError" class="error">
                                <?php echoValue($errors, 'lType'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Seating Available</label>
                        <div class="col-md-5">
                            <?php $seat = (isset($formdata['SeatingAvailable'])) ? ($formdata['SeatingAvailable']) : $row['SeatingAvailable']; ?>
                            <select class="form-control" name="seat">
                                <option>Please Choose</option>
                                <option value=1 <?php echo ($seat == 1) ?  "selected" : "";  ?>> Yes</option>
                                <option value=2 <?php echo ($seat == 2) ?  "selected" : "";  ?>> No</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <span id="typeError" class="error">
                                <?php echoValue($errors, 'seat'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Facilities</label>
                        <div class="col-md-5">
                            <?php $facilities = (isset($formdata['facilities'])) ? ($formdata['facilities']) : array_column($row1, 'Facility');  ?>
                            <input type="checkbox" name="facilities[]" value=1 <?php echo (in_array("1", $facilities)) ?  "checked" : "";  ?>> Sound Room <br>
                            <input type="checkbox" name="facilities[]" value=2 <?php echo (in_array("2", $facilities)) ?  "checked" : "";  ?>> Big Screen Room <br>
                            <input type="checkbox" name="facilities[]" value=3 <?php echo (in_array("3", $facilities)) ?  "checked" : "";  ?>> Restaurants <br>
                            <input type="checkbox" name="facilities[]" value=4 <?php echo (in_array("4", $facilities)) ?  "checked" : "";  ?>> Bar <br>
                            <input type="checkbox" name="facilities[]" value=5 <?php echo (in_array("5", $facilities)) ?  "checked" : "";  ?>> Disabled Access Toilets <br>
                        </div>
                        <div class="col-md-4">
                            <span id="typeError" class="error">
                                <?php echoValue($errors, 'facilities'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Url</label>
                        <div class="col-md-5">
                            <input type="text" class="control-label" name="link" value="<?php echo (isset($formdata['Url'])) ? ($formdata['Url']) :  $row['Url']; ?>">
                        </div>
                        <div class="col-md-4">
                            <span id="urlError" class="error">
                                <?php echoValue($errors, 'link'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Attach File</label>
                        <div class="col-md-5">
                        <img src="uploads/<?php echo (isset($formdata['Image'])) ? ($formdata['Image']) :  $row['Image'] ?>" style="width: 100%; height: auto" id="image">
                        <input type="hidden" class="control-label" name="old_image" value="<?php echo $row['Image'] ?>">
                        <input type="file" id="imageUploaded" class="control-label" name="image" style="display: none;">
                        <label class="btn btn-default" style="margin-top: 2%;" for="imageUploaded">
                            Choose file
                        </label>
                    </div>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-default pull-right" name="editLocation">Update <span
                        class="glyphicon glyphicon-floppy-disk"></span></button>
                <!--submit button-->
                <a class="btn btn-default" href="viewlocations.php"><span
                        class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                <!--return/back button-->

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