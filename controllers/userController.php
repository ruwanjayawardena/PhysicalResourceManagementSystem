<?php

include '../models/user.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new User();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllUser") {
        $ctrl->setUsr_usercategory($_POST['usr_usercategory']);
        $ctrl->getAllUser();
    } else if ($_POST['action'] == "getUserByID") {
        $ctrl->setUsr_id($_POST['usr_id']);
        $ctrl->getUserByID();
    } else if ($_POST['action'] == "loggedUsersInfo") {
        $ctrl->loggedUsersInfo();
    } else if ($_POST['action'] == "deleteUser") {
        $ctrl->setUsr_id($_POST['usr_id']);
        $ctrl->deleteUser();
    } else if ($_POST['action'] == "saveUser") {
        $ctrl->setUsr_name($_POST['usr_name']);
        $ctrl->setUsr_email($_POST['usr_email']);
        $ctrl->setUsr_phone($_POST['usr_phone']);
        $ctrl->setUsr_nic($_POST['usr_nic']);
        $ctrl->setUsr_designation($_POST['usr_designation']);
        $ctrl->setUsr_username($_POST['usr_username']);
        $ctrl->setUsr_password($_POST['usr_password']);
        $ctrl->setUsr_usercategory($_POST['usr_usercategory']);
        $ctrl->saveUser();
    } else if ($_POST['action'] == 'editUser') {
        $ctrl->setUsr_name($_POST['usr_name']);
        $ctrl->setUsr_email($_POST['usr_email']);
        $ctrl->setUsr_phone($_POST['usr_phone']);
        $ctrl->setUsr_nic($_POST['usr_nic']);
        $ctrl->setUsr_designation($_POST['usr_designation']);
        $ctrl->setUsr_username($_POST['usr_username']);
        $ctrl->setUsr_password($_POST['usr_password']);
        $ctrl->setUsr_usercategory($_POST['usr_usercategory']);
        $ctrl->setUsr_id($_POST['usr_id']);
        $ctrl->editUser();
    } else if ($_POST['action'] == 'login') {
        $ctrl->setUsr_username($_POST['usr_username']);
        $ctrl->setUsr_password($_POST['usr_password']);
        $ctrl->login();
    } else if ($_POST['action'] == 'logout') {
        $ctrl->logout();
    }
}