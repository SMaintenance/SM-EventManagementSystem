<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Booking.php';
require_once 'classes/BookingTableGateway.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';


$connection = Connection::getInstance();
$gateway = new BookingTableGateway($connection);

$statement = $gateway->getBookings();

start_session();

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header.php'; ?>
        <div class = "content">
            <div class = "container">
                <?php 
                if (isset($message)) {
                    echo '<p>'.$message.'</p>';
                }
                ?>
                <h3>Booking List</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Customer's Name</th>
                            <th>Contact</th>
                            <th>Title</th>    
                            <th>Event Type</th>               
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                        while ($row) {
                            echo '<tr>';
                            echo '<td>' . $row['FullName'] . '</td>';
                            echo '<td>' . $row['ContactNum'] . '</td>';
                            echo '<td>' . $row['Title'] . '</td>';    
                            echo '<td>' . $row['EventType'] . '</td>';               
                            echo '<td>' . $row['StartDate'] . '</td>';
                            echo '<td>' . $row['EndDate'] . '</td>';
                            echo '<td>'
                            . '<a href="viewLocation.php?id='.$row['LocationID'].'">'.$row['Name'].'</a> '
                            . '</td>';
                            echo '<td>'
                            . '<a href="viewBookingForm.php?id='.$row['BookingID'].'">View</a> '
                            . '</td>';
                            echo '</tr>';  

                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <?php require 'utils/footer.php'; ?>
    </body>
</html>
