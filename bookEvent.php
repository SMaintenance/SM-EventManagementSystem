<?php
ob_start();
require_once 'classes/Booking.php';
require_once 'classes/BookingTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateBooking.php';

$formdata = array();
$errors = array();

validateEvents(INPUT_POST, $formdata, $errors);

if (empty($errors)) {
    $name = $formdata['Name'];
    $email = $formdata['Email'];
    $contactNum = $formdata['ContactNum'];
    $title = $formdata['Title'];
    $description = $formdata['Description'];
    $eventType = $formdata['EventType'];
    $startDate = $formdata['StartDate'];
    $endDate = $formdata['EndDate'];
    $location = $formdata['Location'];

    $booking = new Booking(-1, $name, $email, $contactNum, $title,
                           $description, $eventType, $startDate,
                           $endDate, $location)
                           ;

    $connection = Connection::getInstance();

    $gateway = new BookingTableGateway($connection);

    $id = $gateway->insert($booking);

    header('Location: index.php');
} else {
    require_once 'bookEventForm.php';
}
ob_end_flush();
