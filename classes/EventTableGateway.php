<?php
require_once 'Event.php';

class EventTableGateway
{

    private $connect;
    private $query = "SELECT e.*, l.name FROM events e ";
    private $errmsg = "Could not retrieve event details";

    private $fail_retrieve = "Could not retrieve event details";

    public function __construct($c)
    {
        $this->connect = $c;
    }

    public function getEvents()
    {
        
        // execute a query to get all events
        $sqlQuery = $this->query .
            "LEFT JOIN locations l ON e.locationID = l.locationID";

        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die($this->errmsg);
        }

        return $statement;
    }

    public function getEventsOrderByDate($start, $numEvents)
    {
        // execute a query to get all events
        $sqlQuery = $this->query .
            "LEFT JOIN locations l ON e.locationID = l.locationID ORDER BY StartDate DESC LIMIT :start, :numEvents";
        $statement = $this->connect->prepare($sqlQuery);
        $statement->bindParam(':start', $start, PDO::PARAM_INT);
        $statement->bindParam(':numEvents', $numEvents, PDO::PARAM_INT);
        $status = $statement->execute();

        if (!$status) {
            die($this->errmsg);
        }

        return $statement;
    }


    public function getEventsByLocationId($id)
    {
        // execute a query to get all events
        $sqlQuery = $this->query .
            "LEFT JOIN locations l ON e.locationID = l.locationID " .
            "WHERE e.locationID=:locationId";

        $params = array(
            "locationId" => $id
        );
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die($this->errmsg);
        }

        return $statement;
    }

    public function getNumEvents()
    {
        $sqlQuery = "SELECT COUNT(*) FROM events";
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve event count");
        }

        return $statement->fetchColumn();
    }

    public function getEventsById($id)
    {
        // execute a query to get an event with the specified id
        $sqlQuery = "SELECT * FROM events WHERE eventID = :id";

        $statement = $this->connect->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve Event ID");
        }

        return $statement;
    }

    public function insert($p)
    {
        $sql = "INSERT INTO events(Title, Description, EventType, StartDate, EndDate, Cost, LocationID, Image) " .
            "VALUES (:Title, :Description, :EventType, :StartDate, :EndDate, :Cost, :LocationID, :Image)";

        $statement = $this->connect->prepare($sql);
        $params = array(
            "Title"           => $p->getTitle(),
            "Description"     => $p->getDescription(),
            "EventType"     => $p->getEventType(),
            "StartDate"       => $p->getStartDate(),
            "EndDate"         => $p->getEndDate(),
            "Cost"            => $p->getCost(),
            "LocationID"      => $p->getLocationID(),
            "Image"      => $p->getImage()
        );

        $status = $statement->execute($params);


        if (!$status) {
            die("Could not insert event");
        }

        return $this->connect->lastInsertId();
    }

    public function update($p)
    {
        $sql = "UPDATE events SET " .
            "Title = :Title, " .
            "Description = :Description, " .
            "EventType = :EventType, " .
            "StartDate = :StartDate, " .
            "EndDate = :EndDate, " .
            "Cost = :Cost, " .
            "LocationID = :LocationID, " .
            "Image = :Image " .
            " WHERE eventID = :id";

        $statement = $this->connect->prepare($sql);
        $params = array(
            "Title"          => $p->getTitle(),
            "Description"    => $p->getDescription(),
            "EventType"    => $p->getEventType(),
            "StartDate"      => $p->getStartDate(),
            "EndDate"        => $p->getEndDate(),
            "Cost"           => $p->getCost(),
            "LocationID"     => $p->getLocationID(),
            "Image"     => $p->getImage(),
            "id"             => $p->getId()
        );

        echo "<pre>";
        print_r($statement);
        echo "</pre>";

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not update event details");
        }
    }

    public function delete($id)
    {
        $sql = "UPDATE bookings SET EventID = NULL WHERE EventID = :id";

        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete event id from bookings");
        }

        $sql = "DELETE FROM events WHERE EventID = :id";

        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete event");
        }
        
    }
}
