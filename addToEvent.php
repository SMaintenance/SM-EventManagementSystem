<?php
ob_start();
require_once 'classes/Booking.php';
require_once 'classes/BookingTableGateway.php';
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$bookingId = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new BookingTableGateway($connection);

$statement = $gateway->getBookingsById($bookingId);

$formdata = $statement->fetch(PDO::FETCH_ASSOC);
if (!$formdata) {
    die("Illegal request");
}

if (isset($_POST['submit'])) {
    $title = $formdata['Title'];
    $description = $formdata['Description'];
    $eType = !empty($formdata['EventType']) ? $formdata['EventType'] : null;
    $sDate = $formdata['StartDate'];
    $eDate = $formdata['EndDate'];
    $cost = null;
    $locID = $formdata['LocationID'];

    // Where the file is going to be stored
    $target_dir = "uploads/";
    $file = $_FILES['image']['name'];
    $path = pathinfo($file);
    $filename = $path['filename'];
    $ext = $path['extension'];
    $temp_name = $_FILES['image']['tmp_name'];
    $path_filename_ext = $target_dir . $filename . "." . $ext;

    // Check if file already exists
    if (file_exists($path_filename_ext)) {
        echo "Sorry, file already exists.";
    } else {
        move_uploaded_file($temp_name, $path_filename_ext);
        echo "Congratulations! File Uploaded Successfully.";
    }

    $event = new Event(-1, $title, $description, $eType, $sDate, $eDate, $cost, $locID, $file);

    $connection = Connection::getInstance();

    $gateway = new EventTableGateway($connection);
    $eventId = $gateway->insert($event);
    
    $gateway = new BookingTableGateway($connection);
    $id = $gateway->updateEventId($bookingId, $eventId);
    

    header('Location: viewBookings.php');
}
ob_end_flush();

