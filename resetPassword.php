<?php

require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/DB.php';
require_once 'classes/UserTable.php';

start_session();

try {
    $formdata = array();
    $errors = array();
    
    $input_method = INPUT_POST;

    $formdata['username'] = filter_input($input_method, "username", FILTER_SANITIZE_STRING);
    $formdata['password'] = filter_input($input_method, "password", FILTER_SANITIZE_STRING);
    $formdata['password_confirmation'] = filter_input($input_method, "password_confirmation", FILTER_SANITIZE_STRING);

    if (empty($formdata['username'])) {
        $errors['username'] = "Username required";
    }
    if (empty($formdata['password'])) {
        $errors['password'] = "Password required";
    }

    if (($formdata['password']) != ($formdata['password_confirmation'])) {
        $errors['password_confirmation'] = "Password doesnt match";
    }


    if (empty($errors)) {
        $username = $formdata['username'];
        $password = $formdata['password'];

        $connection = DB::getConnection();
        $userTable = new UserTable($connection);
        $user = $userTable->getUserByUsername($username);

        if ($user == null) {
            $errors['username'] = "Username is not registered";
        }
    }
    
    if (!empty($errors)) {
        throw new Exception("");
    }
    
    $username = $formdata['username'];
    $password = $formdata['password'];
    $connection = DB::getConnection();
    $userTable = new UserTable($connection);
    $user = $userTable->getUserByUsername($username);
    $user->setPassword($password);
    $userTable->update($user);
   
    
    header('Location: login_form.php');
    }
    catch (Exception $ex) {

        $_GET['username'] = $formdata['username'];
        $errorMessage = $ex->getMessage();
        require 'resetpasswordForm.php';
    }
    ?>
