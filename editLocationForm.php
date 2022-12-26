<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';
require_once 'functions.php';

if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new LocationTableGateway($connection);

$statement = $gateway->getLocationsById($id);

$row = $statement->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    die("Illegal request");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Location</title>
    <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
    <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
</head>

<body>
    <?php require 'utils/header.php'; ?><!--header content. file found in utils folder-->
    <div class="content">
        <div class="container">
            <h1 align="center">Edit Location Form</h1><!--form title-->
            <br>
            <?php
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
            <form action="editLocation.php" method="POST" class="form-horizontal">
                <div style="margin-left: 25%">
                    <input type="hidden" name="id"
                        value="<?php echo $row['LocationID']; ?>" /><!--location id. auto incremented in database. cannot be updated from website-->
                    <div class="form-group">
                        <label for="Name" class="col-md-2 control-label">Name</label><!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Name" name="Name"
                                value="<?php echo $row['Name']; ?>" /><!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="LNameError" class="error"></span><!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Address" class="col-md-2 control-label">Address</label><!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Address" name="Address"
                                value="<?php echo $row['Address']; ?>" /><!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="LAddressError" class="error"></span><!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ManagerFName" class="col-md-2 control-label">Manager First Name</label><!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="ManagerFName" name="ManagerFName"
                                value="<?php echo $row['ManagerFName']; ?>" /><!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="mNameError" class="error"></span><!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ManagerLName" class="col-md-2 control-label">Manager Last Name</label><!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="ManagerLName" name="ManagerLName"
                                value="<?php echo $row['ManagerLName']; ?>" /><!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="mNameError" class="error"></span><!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ManagerEmail" class="col-md-2 control-label">Manager Email</label><!--label-->
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="ManagerEmail" name="ManagerEmail"
                                value="<?php echo $row['ManagerEmail']; ?>" /><!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="mEmailError" class="error"></span><!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ManagerNumber" class="col-md-2 control-label">Manager Number</label><!--label-->
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="ManagerNumber" name="ManagerNumber"
                                value="<?php echo $row['ManagerNumber']; ?>" /><!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="mNumError" class="error"></span><!--error message for invalid input-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="MaxCapacity" class="col-md-2 control-label">Max Capacity</label><!--label-->
                        <div class="col-md-5">
                            <input type="number" class="form-control" id="MaxCapacity" name="MaxCapacity"
                                value="<?php echo $row['MaxCapacity']; ?>" /><!--input with current data from database-->
                        </div>
                        <div class="col-md-4">
                            <span id="capError" class="error"></span><!--error message for invalid input-->
                        </div>
                    </div>
                    <!--codes below has no connection with the database.-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Location
                            Type</label><!--radio buttons with multiple options-->
                        <div class="col-md-5">
                            <input type="radio" name="lType" value="indoor"> Indoor <br>
                            <input type="radio" name="lType" value="outdoor"> Outdoor <br>
                            <input type="radio" name="lType" value="both"> Both
                        </div>
                        <div class="col-md-4">
                            <span id="typeError" class="error">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Seating Available</label>
                        <div class="col-md-5">
                            <select class="form-control" name="seat">
                                <option value="yes"> Yes</option>
                                <option value="no"> No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Facilities</label>
                        <div class="col-md-5">
                            <input type="checkbox" name="facilities[]" value="sound"> Sound Room <br>
                            <input type="checkbox" name="facilities[]" value="screen"> Big Screen Room <br>
                            <input type="checkbox" name="facilities[]" value="restaurant"> Restaurants <br>
                            <input type="checkbox" name="facilities[]" value="bar"> Bar <br>
                            <input type="checkbox" name="facilities[]" value="disabled"> Disabled Access Toilets <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Url</label>
                        <div class="col-md-5">
                            <input type="text" class="control-label" name="link">
                        </div>
                        <div class="col-md-4">
                            <span id="urlError" class="error">
                                <?php //echoValue($errors, 'link');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Attach File:</label>
                        <div class="col-md-5">
                            <input type="file" class="control-label" name="attachment">
                        </div>
                    </div>
                </div> <br>
                <button type="submit" class="btn btn-default pull-right" name="editLocation">Update <span
                        class="glyphicon glyphicon-floppy-disk"></span></button><!--submit button-->
                <a class="btn btn-default" href="viewlocations.php"><span
                        class="glyphicon glyphicon-circle-arrow-left"></span> Back</a><!--return/back button-->
            </form>
        </div>
    </div>
    <?php require 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
</body>

</html>