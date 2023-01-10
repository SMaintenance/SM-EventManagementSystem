<?php

function validateLocation($input_method, &$formdata, &$errors) {
    $formdata['Name'] = filter_input($input_method, "Name", FILTER_SANITIZE_STRING);
    $formdata['Address'] = filter_input($input_method, "Address", FILTER_SANITIZE_STRING);
    $formdata['ManagerFName'] = filter_input($input_method, "ManagerFName", FILTER_SANITIZE_STRING);
    $formdata['ManagerLName'] = filter_input($input_method, "ManagerLName", FILTER_SANITIZE_STRING);
    $formdata['ManagerEmail'] = filter_input($input_method, "ManagerEmail", FILTER_SANITIZE_EMAIL);
    $formdata['ManagerNumber'] = filter_input($input_method, "ManagerNumber", FILTER_SANITIZE_NUMBER_INT);
    $formdata['MaxCapacity'] = filter_input($input_method, "MaxCapacity", FILTER_SANITIZE_NUMBER_INT);
    $formdata['LocationType'] = filter_input($input_method, "LocationType", FILTER_SANITIZE_STRING);
    $formdata['facilities'] = filter_input($input_method, "facilities", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    $formdata['link'] = filter_input($input_method, "link", FILTER_SANITIZE_URL);

    if ($formdata['Name'] === NULL ||
                    $formdata['Name'] === FALSE ||
                    $formdata['Name'] === "")
    {
        $errors['Name'] = "Name is required";
    }
    
    if ($formdata['Address'] === NULL ||
                    $formdata['Address'] === FALSE ||
                    $formdata['Address'] === "")
    {
        $errors['Address'] = "Address is required";
    }   
    
    if ($formdata['ManagerFName'] === NULL ||
                    $formdata['ManagerFName'] === FALSE ||
                    $formdata['ManagerFName'] === "")
    {
        $errors['ManagerFName'] = "First Name is required";
    }
    
    if ($formdata['ManagerLName'] === NULL ||
                    $formdata['ManagerLName'] === FALSE ||
                    $formdata['ManagerLName'] === "")
    {
        $errors['ManagerLName'] = "Last Name is required";
    }
    
    if ($formdata['ManagerEmail'] === NULL ||
                    $formdata['ManagerEmail'] === FALSE ||
                    $formdata['ManagerEmail'] === "")
    {
        $errors['ManagerEmail'] = "Manager Email is required";
    }
    
    if ($formdata['ManagerNumber'] === NULL ||
                    $formdata['ManagerNumber'] === FALSE ||
                    $formdata['ManagerNumber'] === "")
    {
         $errors['ManagerNumber'] = "Manager Number is required";
    }
    
    if ($formdata['MaxCapacity'] === ""){
        $capacity = intval($formdata['MaxCapacity']);
        if ($capacity < 0 || $capacity > 999999) {
    }
        $errors['MaxCapacity'] = "Capacity is required. Cannot be a negative value";
    }
    
    if ($formdata['LocationType'] !== NULL &&
                    $formdata['LocationType'] !== FALSE &&
                    $formdata['LocationType'] !== "")
    {
        $type = array(1, 2, 3);
        if(!in_array($formdata['LocationType'], $type)){
            $errors['LocationType'] = "Invalid type";
        }
    }
    
    if ($formdata['facilities'] !== NULL &&
                    $formdata['facilities'] !== FALSE &&
                    $formdata['facilities'] !== "")
    {
        $fcl = array("sound", "screen", "restaurant", "bar", "disabled");
        if(in_array($formdata['facilities'], $fcl)){
            $errors['facilities'] = "Invalid restriction";
        }
    }
    
    if ($formdata['link'] !== NULL &&
                    $formdata['link'] !== FALSE &&
                    $formdata['link'] !== "") {
        if (!filter_var($formdata['link'], FILTER_VALIDATE_URL)){
            $errors['link'] = "Invalid url format";
        }
    }
}
