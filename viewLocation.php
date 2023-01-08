<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$connection = Connection::getInstance();

$gateway = new LocationTableGateway($connection);
$statement = $gateway->getLocationsById($id);

$location = $statement->fetch(PDO::FETCH_ASSOC);
if (!$location) {
    die("Illegal request");
}

$eventGateway = new EventTableGateway($connection);
$events = $eventGateway->getEventsByLocationId($id);
if (!$events) {
    die("Illegal request");
}

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
                    echo '<p>' . $message . '</p>';
                }
                ?>
                <?php
                if ($events->rowCount() > 0) {
                ?>
                <h2>Events at <?php echo $location['Name']?></h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>                    
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Cost</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getRow = $events->fetchAll();
                        $count = 1;
                        foreach ($getRow as $row) {
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $row['Title'] . '</td>';
                            echo '<td>' . $row['Description'] . '</td>';                    
                            echo '<td>' . $row['StartDate'] . '</td>';
                            echo '<td>' . $row['EndDate'] . '</td>';
                            echo '<td>' . $row['Cost'] . '</td>';
                            echo '<td>'
                            . $row['name']
                            . '</td>';
                            echo '</tr>';  
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                } else {
                ?>
                <p>There are no events for this location.</p>
                <?php
                }
                ?>
                <a class="btn btn-default" href="viewLocations.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
        </div>
        
        <?php require 'utils/footer.php'; ?>
    </body>
</html>
