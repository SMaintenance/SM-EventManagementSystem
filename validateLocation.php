<?php

function validateLocation($inputMethod, &$formdata, &$errors)
{
    $formdata['Name'] = filter_input($inputMethod, "Name", FILTER_SANITIZE_STRING);
    $formdata['Address'] = filter_input($inputMethod, "Address", FILTER_SANITIZE_STRING);
    $formdata['managerFName'] = filter_input($inputMethod, "managerFName", FILTER_SANITIZE_STRING);
    $formdata['managerLName'] = filter_input($inputMethod, "managerLName", FILTER_SANITIZE_STRING);
    $formdata['managerEmail'] = filter_input($inputMethod, "managerEmail", FILTER_SANITIZE_EMAIL);
    $formdata['managerNumber'] = filter_input($inputMethod, "managerNumber", FILTER_SANITIZE_NUMBER_INT);
    $formdata['maxCap'] = filter_input($inputMethod, "maxCap", FILTER_SANITIZE_NUMBER_INT);
    $formdata['lType'] = filter_input($inputMethod, "lType", FILTER_SANITIZE_STRING);
    $formdata['facilities'] = filter_input($inputMethod, "facilities", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    $formdata['link'] = filter_input($inputMethod, "link", FILTER_SANITIZE_URL);

    if ($formdata['Name'] === null ||
                    $formdata['Name'] === false ||
                    $formdata['Name'] === "") {
        $errors['Name'] = "Name is required";
    }
    
    if ($formdata['Address'] === null ||
                    $formdata['Address'] === false ||
                    $formdata['Address'] === "") {
        $errors['Address'] = "Address is required";
    }
    
    if ($formdata['managerFName'] === null ||
                    $formdata['managerFName'] === false ||
                    $formdata['managerFName'] === "") {
        $errors['managerFName'] = "First Name is required";
    }
    
    if ($formdata['managerLName'] === null ||
                    $formdata['managerLName'] === false ||
                    $formdata['managerLName'] === "") {
        $errors['managerLName'] = "Last Name is required";
    }
    
    if ($formdata['managerEmail'] === null ||
                    $formdata['managerEmail'] === false ||
                    $formdata['managerEmail'] === "") {
        $errors['managerEmail'] = "Manager Email is required";
    }
    
    if ($formdata['managerNumber'] === null ||
                    $formdata['managerNumber'] === false ||
                    $formdata['managerNumber'] === "") {
         $errors['managerNumber'] = "Manager Number is required";
    }
    
    if ($formdata['maxCap'] === "") {
        $capacity = intval($formdata['maxCap']);
        $errors['maxCap'] = "Capacity is required. Cannot be a negative value";
    }
    
    if ($formdata['lType'] !== null &&
                    $formdata['lType'] !== false &&
                    $formdata['lType'] !== "") {
        $type = array(1, 2, 3);
        if (!in_array($formdata['lType'], $type)){
            $errors['lType'] = "Invalid type";
        }
    }
    
    if ($formdata['facilities'] !== null &&
                    $formdata['facilities'] !== false &&
                    $formdata['facilities'] !== "") {
        $fcl = array("sound", "screen", "restaurant", "bar", "disabled");
        if (in_array($formdata['facilities'], $fcl)){
            $errors['facilities'] = "Invalid restriction";
        }
    }
    
    if ($formdata['link'] !== null &&
                    $formdata['link'] !== false &&
                    $formdata['link'] !== "") {
        if (!filter_var($formdata['link'], FILTER_VALIDATE_URL)){
            $errors['link'] = "Invalid url format"; 
        }
    }
}
