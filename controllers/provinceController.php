<?php

include '../models/province.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Province();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllProvince") {
        $ctrl->getAllProvince();
    } else if ($_POST['action'] == "getProvinceByID") {
        $ctrl->setProv_id($_POST['prov_id']);
        $ctrl->getProvinceByID();
    } else if ($_POST['action'] == "cmbProvince") {
        $ctrl->cmbProvince();
    } else if ($_POST['action'] == "deleteProvince") {
        $ctrl->setProv_id($_POST['prov_id']);
        $ctrl->deleteProvince();
    } else if ($_POST['action'] == "saveProvince") {
        $ctrl->setProv_name($_POST['prov_name']);
        $ctrl->saveProvince();
    } else if ($_POST['action'] == 'editProvince') {
        $ctrl->setProv_id($_POST['prov_id']);
        $ctrl->setProv_name($_POST['prov_name']);
        $ctrl->editProvince();
    }
}