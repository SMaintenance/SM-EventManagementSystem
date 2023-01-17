<?php
require_once 'Booking.php';

class BookingTableGateway
{

    private $connect;
    
    public function __construct($c)
    {
        $this->connect = $c;
    }

    public function getBookings()
    {
        // execute a query to get all bookings
        $sqlQuery = "SELECT * FROM bookings LEFT JOIN locations
        ON bookings.LocationID = locations.LocationID";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve booking details");
        }
        
        return $statement;
    }

    public function getBookingsById($id)
    {
        // execute a query to get all bookings
        $sqlQuery = "SELECT * FROM bookings LEFT JOIN locations
        ON bookings.LocationID = locations.LocationID WHERE BookingID = $id";
        
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve booking details");
        }
        
        return $statement;
    }
    
    public function insert($p)
    {
        $sql = "INSERT INTO bookings(FullName, Email, ContactNum, Title,
        Description, EventType, StartDate, EndDate, LocationID)
        VALUES (:FullName, :Email, :ContactNum, :Title,
        :Description, :EventType, :StartDate, :EndDate, :LocationID)";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "FullName"        => $p->getName(),
            "Email"           => $p->getEmail(),
            "ContactNum"      => $p->getContactNum(),
            "Title"           => $p->getTitle(),
            "Description"     => $p->getDescription(),
            "EventType"       => $p->getEventType(),
            "StartDate"       => $p->getStartDate(),
            "EndDate"         => $p->getEndDate(),
            "LocationID"      => $p->getLocation()
        );
        
        $status = $statement->execute($params);
        
        
        if (!$status) {
            die("Could not insert booking");
        }
        
        return  $this->connect->lastInsertId();
    }

    public function updateEventId($bookingId, $eventId)
    {
        $sql = "UPDATE bookings SET EventID = :EventID WHERE BookingID = :BookingID";

        $statement = $this->connect->prepare($sql);
        $params = array(
            "BookingID" => $bookingId,
            "EventID" => $eventId
        );
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not update event id");
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM bookings WHERE BookingID = :id";

        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete booking");
        }
    }
}
