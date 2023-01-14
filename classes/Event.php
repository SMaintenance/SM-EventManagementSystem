<?php
class Event
{
    private $title;
    private $description;  
    private $eventType;
    private $startDate;
    private $endDate;
    private $cost;
    private $locationID;
    private $image;
    
    public function __construct($id, $title, $description, $eType, 
    $sDate, $eDate, $cost, $locID, $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->eventType = $eType;
        $this->startDate = $sDate;
        $this->endDate = $eDate;
        $this->cost = $cost;
        $this->locationID = $locID;
        $this->image = $image;
    }
    
    public function getId()
    { return $this->id; }
    public function getTitle()
    { return $this->title; }
    public function getDescription()
    { return $this->description; }
    public function getEventType()
    { return $this->eventType; }
    public function getStartDate()
    { return $this->startDate; }
    public function getEndDate()
    { return $this->endDate; }
    public function getCost()
    { return $this->cost; }
    public function getLocationID()
    { return $this->locationID; }
    public function getImage()
    { return $this->image; }
}
