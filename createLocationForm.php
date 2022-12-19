<?php
require_once 'functions.php';

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
        <title>Create Location Form</title>
        <style>
            span.error{
                color: red;
            }            
        </style>  
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
        <?php require 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class="content">
            <div class="container" style="width:50%">
                <h1 style="text-align:center">Create Location Form </h1><!--form title-->
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="createLocation.php" method="POST">
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Name" class="control-label">Location Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="Name" name="Name" value="<?php echoValue($formdata, "Name")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="LNameError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'Name');?>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Address" class="control-label">Address</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="Address" name="Address" value="<?php echoValue($formdata, "Address")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="LAddressError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'Address');?>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="managerFName" class="control-label">Manager First Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="managerFName" name="managerFName" value="<?php echoValue($formdata, "managerFName")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="mNameError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'managerFName');?>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="managerLName" class="control-label">Manager Last Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="managerLName" name="managerLName" value="<?php echoValue($formdata, "managerLName")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="mNameError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'managerLName');?>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="managerEmail" class="control-label">Manager Email</label>
                        </div>
                        <div class="col-md-9">
                            <input type="email" class="form-control" id="managerEmail" name="managerEmail" value="<?php echoValue($formdata, "managerEmail")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="mEmailError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'managerEmail');?>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="managerNumber" class="control-label">Manager Number</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="managerNumber" name="managerNumber" value="<?php echoValue($formdata, "managerNumber")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="mNumError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'managerNumber');?>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="locationMaxCap" class="control-label">Max Capacity</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="locationMaxCap" name="maxCap" value="<?php echoValue($formdata, "maxCap")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="capError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'maxCap');?>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 control-label">Location Type</label>
                        <div class="col-md-5">
                            <input type="radio"  name="lType" value=1 <?php echoChecked($formdata, "lType", 1); ?> >Indoor <br>
                            <input type="radio" name="lType" value=2 <?php echoChecked($formdata, "lType", 2); ?>>Outdoor <br>
                            <input type="radio" name="lType" value=3 <?php echoChecked($formdata, "lType", 3); ?>>Both
                        </div>
                        <div class="col-md-3">
                            <span id="typeError" class="error">
                                <?php echoValue($errors, 'lType');?>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="seating" class="col-md-3 control-label">Seating Available</label>
                        <div class="col-md-5">
                            <select name="seating" id="seating" class="form-control">
                                <option value=0>Please Choose</option>
                                <option value=1 >Yes</option>
                                <option value=2 >No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <span id="typeError" class="error">
                                <?php echo implode($formdata);?>
                            </span>
                        </div>
                    </div>    
                    <div class="row form-group">
                        <label class="col-md-3 control-label">Facilities</label>
                        <div class="col-md-5">
                            <input type="checkbox" name="facilities[]" value=1 <?php echoCheckedArray($formdata, 'facilities', 1); ?> >Sound Room <br>
                            <input type="checkbox" name="facilities[]" value=2 <?php echoCheckedArray($formdata, "facilities", 2); ?> >Big Screen Room <br>
                            <input type="checkbox" name="facilities[]" value=3 <?php echoCheckedArray($formdata, "facilities", 3); ?> >Restaurants <br>
                            <input type="checkbox" name="facilities[]" value=4 <?php echoCheckedArray($formdata, "facilities", 4); ?> >Bar <br>
                            <input type="checkbox" name="facilities[]" value=5 <?php echoCheckedArray($formdata, "facilities", 5); ?> >Disabled Access Toilets <br>
                        </div>
                        <div class="col-md-3">
                            <span id="typeError" class="error">
                                <?php echoValue($errors, 'facilities');?>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="Url" class="control-label">Url</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="link" name="link" value="<?php echoValue($formdata, "link")?>" /><!--input-->
                        </div>
                        <div class="col-md-offset-3" style="padding-left:15px">
                            <span id="LinkError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'link');?>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 control-label">Attach File:</label>
                        <div class="col-md-5">
                            <input type="file" class="control-label" name="image">
                        </div>
                    </div>
                <button type="submit" class="btn btn-default pull-right">Create Location <span class="glyphicon glyphicon-send"></span></button>
                </form>
                <a class="btn btn-default" href="viewLocations.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a><!--return/back button-->
            </div>
        </div>
        <?php require 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
    </body>
</html>
