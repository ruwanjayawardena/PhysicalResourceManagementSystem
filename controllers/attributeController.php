<?php

include '../models/attribute.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Attribute();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllAttribute") {
        $ctrl->setAt_attributetype($_POST['at_attributetype']);
        $ctrl->getAllAttribute();
    } else if ($_POST['action'] == "getAttributeByID") {
        $ctrl->setAt_id($_POST['at_id']);
        $ctrl->getAttributeByID();
    } else if ($_POST['action'] == "cmbAttribute") {
        $ctrl->setAt_attributetype($_POST['at_attributetype']);
        $ctrl->cmbAttribute();
    } else if ($_POST['action'] == "deleteAttribute") {
        $ctrl->setAt_id($_POST['at_id']);
        $ctrl->deleteAttribute();
    } else if ($_POST['action'] == "saveAttribute") {
        $ctrl->setAt_name($_POST['at_name']);
        $ctrl->setAt_price($_POST['at_price']);
        $ctrl->setAt_attributetype($_POST['at_attributetype']);
        $ctrl->saveAttribute();
    } else if ($_POST['action'] == 'editAttribute') {
        $ctrl->setAt_name($_POST['at_name']);
        $ctrl->setAt_price($_POST['at_price']);
        $ctrl->setAt_attributetype($_POST['at_attributetype']);
        $ctrl->setAt_id($_POST['at_id']);
        $ctrl->editAttribute();
    }
}