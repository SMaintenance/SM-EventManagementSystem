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
                            <th>No</th>
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
                        $count = 1;
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                        while ($row) {
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $row['FullName'] . '</td>';
                            echo '<td>' . $row['ContactNum'] . '</td>';
                            echo '<td>' . $row['Title'] . '</td>';
                            if($row['EventType'] == 1){
                                echo '<td> Wedding </td>';
                            }
                            else if($row['EventType'] == 2){
                                echo '<td> Birthday </td>';
                            }
                            else if($row['EventType'] == 3){
                                echo '<td> Fashion </td>';
                            }
                            else if($row['EventType'] == 4){
                                echo '<td> Meeting </td>';
                            }             
                            echo '<td>' . $row['StartDate'] . '</td>';
                            echo '<td>' . $row['EndDate'] . '</td>';
                            echo '<td>'
                            . '<a href="viewLocation.php?id='.$row['LocationID'].'">'.$row['Name'].'</a> '
                            . '</td>';
                            if(isset($row['EventID'])){
                                echo '<td>'
                                . '<a href="viewBookingForm.php?id='.$row['BookingID'].'"><span class="glyphicon glyphicon-eye-open mr-2"></span></a>'
                                . '<a onclick="deleteBooking('.$row['BookingID'].')"><span class="glyphicon glyphicon-trash mr-2"></span></a> '
                                . '<a href="removeFromEvent.php?id='.$row['EventID'].'">&nbspRemove from Event</a> '
                                . '</td>';
                            }
                            else{
                                echo '<td>'
                                . '<a href="viewBookingForm.php?id='.$row['BookingID'].'"><span class="glyphicon glyphicon-eye-open mr-2"></span></a>'
                                . '<a onclick="deleteBooking('.$row['BookingID'].')" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash mr-2"></span></a> '
                                . '<a onclick="addToEvent('.$row['BookingID'].')" data-toggle="modal" data-target="#imageModal">&nbspAdd to Event</a> '
                                . '</td>';
                            }
                            echo '</tr>';  

                            $count++;
                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- add to event modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modalLabelSmall">Add an image to continue</h4>
                    </div>

                    <div id="modal-content" class="modal-body">
                        <form id="image-form" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Attach Event Image</label>
                                <div class="col-md-5">
                                    <img src="uploads/<?php echo "noImage.png" ?>" style="width: 100%; height: auto" id="image">
                                    <input type="file" id="imageUploaded" class="control-label" name="image" style="display: none;" required>
                                    <label class="btn btn-default" style="margin-top: 3%;" for="imageUploaded">
                                        Choose file
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-default pull-right submit mr-3">Add to Event <span class="glyphicon glyphicon-send"></span></button>
                                <button type="button" class="btn btn-default pull-right mr-1" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modalLabelSmall">Delete Booking</h4>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this booking?
                    </div>
                    <form id="delete-form" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-footer">
                            <button type="submit" class="delete btn btn-default pull-right">Delete <span class="glyphicon glyphicon-trash"></span></button>
                            <button type="button" class="btn btn-default pull-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            //add to event
            function addToEvent(id) {
                document.getElementById("image-form").action = "addToEvent.php?id="+id;
            }

            function deleteBooking(id) {
                document.getElementById("delete-form").action = "deleteBooking.php?id="+id;
                
            }

            document.getElementById('imageUploaded').onchange = function() {
            document.getElementById('image').src = URL.createObjectURL(imageUploaded.files[0]);
        }
        </script>
        
        <?php require 'utils/footer.php'; ?>
    </body>
</html>
