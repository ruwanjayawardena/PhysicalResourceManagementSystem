<?php

include '../models/division.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Division();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllDivision") {
        $ctrl->setDiv_zone($_POST['div_zone']);
        $ctrl->getAllDivision();
    } else if ($_POST['action'] == "getDivisionByID") {
        $ctrl->setDiv_id($_POST['div_id']);
        $ctrl->getDivisionByID();
    } else if ($_POST['action'] == "cmbDivision") {
        $ctrl->setDiv_zone($_POST['div_zone']);
        $ctrl->cmbDivision();
    } else if ($_POST['action'] == "deleteDivision") {
        $ctrl->setDiv_id($_POST['div_id']);
        $ctrl->deleteDivision();
    } else if ($_POST['action'] == "saveDivision") {
        $ctrl->setDiv_name($_POST['div_name']);
        $ctrl->setDiv_zone($_POST['div_zone']);
        $ctrl->saveDivision();
    } else if ($_POST['action'] == 'editDivision') {
        $ctrl->setDiv_id($_POST['div_id']);
        $ctrl->setDiv_name($_POST['div_name']);
        $ctrl->setDiv_zone($_POST['div_zone']);
        $ctrl->editDivision();
    }
}