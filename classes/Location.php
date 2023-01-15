<?php
class Location
{
    private $name;
    private $address;
    private $managerFName;
    private $managerLName;
    private $managerEmail;
    private $managerNumber;
    private $maxCapacity;
    private $locationType = null;
    private $seat = null;
    private $facilities = null;
    private $url = null;
    private $image = null;

    public function __construct($id, $name, $address, $manFName, $manLName, $manEmail,
    $manNumber, $maxCap, $locationType, $seat, $facilities, $url, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->managerFName = $manFName;
        $this->managerLName = $manLName;
        $this->managerEmail = $manEmail;
        $this->managerNumber = $manNumber;
        $this->maxCapacity = $maxCap;
        $this->locationType = $locationType;
        $this->seat = $seat;
        $this->facilities = $facilities;
        $this->url = $url;
        $this->image = $image;
    }
    
    public function getId()
    { return $this->id; }
    public function getName()
    { return $this->name; }
    public function getAddress()
    { return $this->address; }
    public function getMFName()
    { return $this->managerFName; }
    public function getMLName()
    { return $this->managerLName; }
    public function getMEmail()
    { return $this->managerEmail; }
    public function getMNumber()
    { return $this->managerNumber; }
    public function getCap()
    { return $this->maxCapacity; }
    public function getLocationType()
    { return $this->locationType; }
    public function getSeat()
    { return $this->seat; }
    public function getFacilities()
    { return $this->facilities; }
    public function getUrl()
    { return $this->url; }
    public function getImage()
    { return $this->image; }
}
