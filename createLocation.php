<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateLocation.php';

$formdata = array();
$errors = array();

validateLocation(INPUT_POST, $formdata, $errors);

if (empty($errors)) {
    $locationName = $formdata['Name'];
    $locationAddress = $formdata['Address'];    
    $managerFName = $formdata['managerFName'];
    $managerLName = $formdata['managerLName'];
    $managerEmail = $formdata['managerEmail'];
    $managerNumber = $formdata['managerNumber'];
    $maxCap = $formdata['maxCap'];
    // $locationType = $formdata['lType'];
    // $seat = $formdata['seat'];
    // $facilities = $formdata['facilities'];
    // $url= $formdata['url'];
    // $image = $formdata['image'];

    $location = new Location(-1, $locationName, $locationAddress, $managerFName, $managerLName, $managerEmail, $managerNumber, $maxCap);

    // $location = new Location(-1, $locationName, $locationAddress, $managerFName, $managerLName, $managerEmail, $managerNumber, $maxCap, $locationType, $seat, $facilities, $url, $image);

    $connection = Connection::getInstance();

    $gateway = new LocationTableGateway($connection);

    $id = $gateway->insert($location);

    header('Location: homeIn.php');
}
else {
    require 'createLocationForm.php';
}