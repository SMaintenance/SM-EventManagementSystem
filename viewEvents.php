<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';
require_once 'utils/checkLogin.php';

$connection = Connection::getInstance();
$gateway = new EventTableGateway($connection);

$statement = $gateway->getEvents();

start_session();

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <?php require_once 'utils/styles.php'; ?>
    <?php require_once 'utils/scripts.php'; ?>
</head>

<body>
    <?php require_once 'utils/header.php'; ?>
    <div class="content">
        <div class="container">
            <?php
            if (isset($message)) {
                echo '<p>' . $message . '</p>';
            }
            ?>
            <h3>Event List</h3>
            <table class="table table-hover" aria-describedby="event list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Cost</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    $count = 1;
                    while ($row) {
                        echo '<tr>';
                        echo '<td>' . $count . '</td>';
                        echo '<td>' . $row['Title'] . '</td>';
                        echo '<td>' . $row['Description'] . '</td>';
                        echo '<td>' . $row['StartDate'] . '</td>';
                        echo '<td>' . $row['EndDate'] . '</td>';
                        echo '<td>' . $row['Cost'] . '</td>';
                        echo '<td>'
                            . '<a href="viewLocation.php?id=' . $row['LocationID'] . '">' . $row['name'] . '</a> '
                            . '</td>';
                        echo '<td>'
                            . '<a href="editEventForm.php?id=' . $row['EventID'] . '&locId=' .
                            $row['LocationID'] . '"><span class="glyphicon glyphicon-pencil mr-2"></a> '
                            . '<a onclick="deleteEvent(' . $row['EventID'] . ')" data-toggle="modal" 
                            data-target="#deleteModal" class="deleteButton" style="cursor:pointer;">
                            <span class="glyphicon glyphicon-trash"></a>'
                            . '</td>';
                        echo '</tr>';

                        $count++;
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>

            <a class="btn btn-default" href="createEventForm.php">Create Event</a><!--register button-->
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
                </div>
                <form id="delete-form" action="" method="post">
                    <div class="modal-body" id="eventTitle">
                        <input type="hidden" name="deleteId" id="deleteId">
                        Are you sure you want to delete this event?
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteEvent(id) {
            document.getElementById("delete-form").action = "deleteEvent.php?id=" + id;

        }
    </script>

    <?php require_once 'utils/footer.php'; ?>
</body>

</html>