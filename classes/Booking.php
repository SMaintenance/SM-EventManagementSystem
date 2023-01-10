<?php
class Booking {
    private $name;
    private $email;
    private $contactNum;
    private $title;
    private $description;
    private $eventType;
    private $startDate;
    private $endDate;
    private $location;

    public function __construct($id, $name, $email, $contactNum, $title, $description, $eventType, $startDate, $endDate, $location) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->contactNum = $contactNum;
        $this->title = $title;
        $this->description = $description;
        $this->eventType = $eventType;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->location = $location;
    }
    
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getContactNum() { return $this->contactNum; }
    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getEventType() { return $this->eventType; }
    public function getStartDate() { return $this->startDate; }
    public function getEndDate() { return $this->endDate; }
    public function getLocation() { return $this->location; }
}
?>