<?php
require_once 'Location.php';

class LocationTableGateway
{

    private $connect;

    public function __construct($c)
    {
        $this->connect = $c;
    }

    // execute a query to get all locations
    public function getLocations()
    {
        $sqlQuery = "SELECT * FROM locations";

        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve location details");
        }

        return $statement;
    }

    // execute a query to get a location with the specified id
    public function getLocationsById($id)
    {
        $sqlQuery = "SELECT * FROM locations WHERE locationID = :id";

        $statement = $this->connect->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve location ID");
        }

        return $statement;
    }

    // execute a query to get a facilities with the specified location id
    public function getFacilitiesById($id)
    {
        $sqlQuery = "SELECT Facility FROM `facilities` WHERE LocationID=:id";

        $statement = $this->connect->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve facilities ID");
        }

        return $statement;
    }

    //execute a insert sql statement that inserts data taken from user to a database.
    public function insert($p)
    {
        $sql = "INSERT INTO locations(Name, Address, ManagerFName, ManagerLName, ManagerEmail, ManagerNumber, MaxCapacity, LocationType, SeatingAvailable,  Url, Image) VALUES (:Name, :Address,:ManagerFName , :ManagerLName, :ManagerEmail, :ManagerNumber, :MaxCapacity, :LocationType, :Seat, :Url, :Image)";

        $statement = $this->connect->prepare($sql);
        $params = array(
            "Name"              => $p->getName(),
            "Address"           => $p->getAddress(),
            "ManagerFName"      => $p->getMFName(),
            "ManagerLName"      => $p->getMLName(),
            "ManagerEmail"      => $p->getMEmail(),
            "ManagerNumber"     => $p->getMNumber(),
            "MaxCapacity"       => $p->getCap(),
            "LocationType"      => $p->getLocationType(),
            "Seat"              => $p->getSeat(),
            "Url"               => $p->getUrl(),
            "Image"             => $p->getImage()
        );

        echo "<pre>";
        print_r($p);
        print_r($params);
        echo "</pre>";

        $status = $statement->execute($params);


        if (!$status) {
            die("Could not insert location");
        }

        $id = $this->connect->lastInsertId();

        // Insert Facilities into Facilities table
        foreach ($p->getFacilities() as $facility) {
            $sqlQuery = "INSERT INTO facilities(Facility, LocationID) VALUES ($facility, :id)";

            $statement = $this->connect->prepare($sqlQuery);
            $params = array(
                "id" => $id
            );

            $status = $statement->execute($params);

            if (!$status) {
                die("Could not insert facilities");
            }
        }

        return $id;
    }



    public function update($p)
    {

        $sql = "UPDATE locations SET " .
            "Name = :Name, " .
            "Address = :Address, " .
            "ManagerFName = :ManagerFName, " .
            "ManagerLName = :ManagerLName, " .
            "ManagerEmail = :ManagerEmail, " .
            "ManagerNumber = :ManagerNumber, " .
            "MaxCapacity = :MaxCapacity, " .
            "LocationType = :LocationType, " .
            "SeatingAvailable = :SeatingAvailable, " .
            "Url = :Url, " .
            "Image = :Image " .
            " WHERE locationID = :id";

        $statement = $this->connect->prepare($sql);
        $params = array(
            "Name"              => $p->getName(),
            "Address"           => $p->getAddress(),
            "ManagerFName"      => $p->getMFName(),
            "ManagerLName"      => $p->getMLName(),
            "ManagerEmail"      => $p->getMEmail(),
            "ManagerNumber"     => $p->getMNumber(),
            "MaxCapacity"       => $p->getCap(),
            "LocationType"      => $p->getLocationType(),
            "SeatingAvailable"  => $p->getSeat(),
            "Url"               => $p->getUrl(),
            "Image"             => $p->getImage(),
            "id"                => $p->getId()
        );

        echo "<pre>";
        print_r($p);
        print_r($params);
        print_r($statement);
        echo "</pre>";

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not update location details");
        }

        // Update Facilities into Facilities table

        $sqlQuery = "DELETE FROM facilities WHERE LocationID=:id";

        $statement = $this->connect->prepare($sqlQuery);
        $params = array(
            "id" => $p->getId()
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete facilities");
        }

        foreach ($p->getFacilities() as $facility) {
            $sqlQuery = "INSERT INTO facilities(Facility, LocationID) VALUES ($facility, :id)";

            $statement = $this->connect->prepare($sqlQuery);
            $params = array(
                "id" => $p->getId()
            );

            $status = $statement->execute($params);

            if (!$status) {
                die("Could not insert facilities");
            }
        }
    }
    
    public function delete($id) {
        $sql = "DELETE FROM facilities WHERE LocationID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not delete facilities");
        }

        $sql = "DELETE FROM locations WHERE LocationID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete location");
        }
    }
}
