<?php

include '../models/zonal.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Zonal();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllZonal") {
        $ctrl->setZol_province($_POST['zol_province']);
        $ctrl->getAllZonal();
    } else if ($_POST['action'] == "getZonalByID") {
        $ctrl->setZol_id($_POST['zol_id']);
        $ctrl->getZonalByID();
    } else if ($_POST['action'] == "cmbZonal") {
        $ctrl->setZol_province($_POST['zol_province']);
        $ctrl->cmbZonal();
    } else if ($_POST['action'] == "deleteZonal") {
        $ctrl->setZol_id($_POST['zol_id']);
        $ctrl->deleteZonal();
    } else if ($_POST['action'] == "saveZonal") {
        $ctrl->setZol_name($_POST['zol_name']);
        $ctrl->setZol_province($_POST['zol_province']);
        $ctrl->saveZonal();
    } else if ($_POST['action'] == 'editZonal') {
        $ctrl->setZol_id($_POST['zol_id']);
        $ctrl->setZol_name($_POST['zol_name']);
        $ctrl->setZol_province($_POST['zol_province']);
        $ctrl->editZonal();
    }
}