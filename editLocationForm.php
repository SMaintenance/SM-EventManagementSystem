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
                <input type="hidden" name="id" value="<?php echo $row['LocationID']; ?>" />
                <!--location id. auto incremented in database. cannot be updated from website-->
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="Name" class="control-label">Name</label>
                    </div>
                    <!--label-->
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="Name" name="Name"
                            value="<?php echo $row['Name']; ?>" />
                        <!--input with current data from database-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px;">
                        <span id="LNameError" class="error"></span>
                        <!--error message for invalid input-->
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="Address" class="control-label">Address</label>
                    </div>
                    <!--label-->
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="Address" name="Address"
                            value="<?php echo $row['Address']; ?>" />
                        <!--input with current data from database-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px;">
                        <span id="LAddressError" class="error"></span>
                        <!--error message for invalid input-->
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="ManagerFName" class="control-label">Manager First Name</label>
                    </div>
                    <!--label-->
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="ManagerFName" name="ManagerFName"
                            value="<?php echo $row['ManagerFName']; ?>" />
                        <!--input with current data from database-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px;">
                        <span id="mNameError" class="error"></span>
                        <!--error message for invalid input-->
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="ManagerLName" class="control-label">Manager Last Name</label>
                    </div>
                    <!--label-->
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="ManagerLName" name="ManagerLName"
                            value="<?php echo $row['ManagerLName']; ?>" />
                        <!--input with current data from database-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px;">
                        <span id="mNameError" class="error"></span>
                        <!--error message for invalid input-->
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="ManagerEmail" class="control-label">Manager Email</label>
                    </div>
                    <!--label-->
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="ManagerEmail" name="ManagerEmail"
                            value="<?php echo $row['ManagerEmail']; ?>" />
                        <!--input with current data from database-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px">
                        <span id="mEmailError" class="error"></span>
                        <!--error message for invalid input-->
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="ManagerNumber" class="control-label">Manager Number</label>
                    </div>
                    <!--label-->
                    <div class="col-md-9">
                        <input type="number" class="form-control" id="ManagerNumber" name="ManagerNumber"
                            value="<?php echo $row['ManagerNumber']; ?>" />
                        <!--input with current data from database-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px;">
                        <span id="mNumError" class="error"></span>
                        <!--error message for invalid input-->
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="MaxCapacity" class="control-label">Max Capacity</label>
                    </div>
                    <!--label-->
                    <div class="col-md-9">
                        <input type="number" class="form-control" id="MaxCapacity" name="MaxCapacity"
                            value="<?php echo $row['MaxCapacity']; ?>" />
                        <!--input with current data from database-->
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px;">
                        <span id="capError" class="error"></span>
                        <!--error message for invalid input-->
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label class="control-label">Location
                        Type</label>
                    </div>    
                    <!--radio buttons with multiple options-->
                    <div class="col-md-9">
                        <?php $lType = $row['LocationType']; ?>
                        <input type="radio" name="lType" value=1 <?php echo ($lType == 1) ? "checked" : ""; ?>> Indoor
                        <br>
                        <input type="radio" name="lType" value=2 <?php echo ($lType == 2) ? "checked" : ""; ?>> Outdoor
                        <br>
                        <input type="radio" name="lType" value=3 <?php echo ($lType == 3) ? "checked" : ""; ?>> Both
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px">
                        <span id="typeError" class="error">
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label class="control-label">Seating Available</label>
                    </div>
                    <div class="col-md-9">
                        <?php $seat = $row['SeatingAvailable']; ?>
                        <select class="form-control" name="seat">
                            <option>Please Choose</option>
                            <option value=1 <?php echo ($seat == 1) ? "selected" : ""; ?>> Yes</option>
                            <option value=2 <?php echo ($seat == 2) ? "selected" : ""; ?>> No</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label class="control-label">Facilities</label>
                    </div>
                    <div class="col-md-9">
                        <?php $facilities = array_column($row1, 'Facility'); ?>
                        <input type="checkbox" name="facilities[]" value=1 <?php echo (in_array("1", $facilities)) ? "checked" : ""; ?>> Sound Room <br>
                        <input type="checkbox" name="facilities[]" value=2 <?php echo (in_array("2", $facilities)) ? "checked" : ""; ?>> Big Screen Room <br>
                        <input type="checkbox" name="facilities[]" value=3 <?php echo (in_array("3", $facilities)) ? "checked" : ""; ?>> Restaurants <br>
                        <input type="checkbox" name="facilities[]" value=4 <?php echo (in_array("4", $facilities)) ? "checked" : ""; ?>> Bar <br>
                        <input type="checkbox" name="facilities[]" value=5 <?php echo (in_array("5", $facilities)) ? "checked" : ""; ?>> Disabled Access Toilets <br>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="Url" class="control-label">Url</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="link" value="<?php echo $row['Url']; ?>">
                    </div>
                    <div class="col-md-offset-3" style="padding-left: 15px;">
                        <span id="urlError" class="error">
                        </span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label class="control-label">Attach File</label>
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