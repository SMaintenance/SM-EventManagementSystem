<?php
require_once 'classes/Booking.php';
require_once 'classes/BookingTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$connection = Connection::getInstance();

$gateway = new BookingTableGateway($connection);

$gateway->delete($id);

header('Location: viewBookings.php');