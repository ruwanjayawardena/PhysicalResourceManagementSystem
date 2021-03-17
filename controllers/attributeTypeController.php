<?php

include '../models/attributeType.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new AttributeType();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllAttributeType") {
        $ctrl->setAttype_item($_POST['attype_item']);
        $ctrl->getAllAttributeType();
    } else if ($_POST['action'] == "getAttributeTypeByID") {
        $ctrl->setAttype_id($_POST['attype_id']);
        $ctrl->getAttributeTypeByID();
    } else if ($_POST['action'] == "cmbAttributeType") {
        $ctrl->setAttype_item($_POST['attype_item']);
        $ctrl->cmbAttributeType();
    } else if ($_POST['action'] == "deleteAttributeType") {
        $ctrl->setAttype_id($_POST['attype_id']);
        $ctrl->deleteAttributeType();
    } else if ($_POST['action'] == "saveAttributeType") {
        $ctrl->setAttype_name($_POST['attype_name']);
        $ctrl->setAttype_item($_POST['attype_item']);
        $ctrl->saveAttributeType();
    } else if ($_POST['action'] == 'editAttributeType') {
        $ctrl->setAttype_name($_POST['attype_name']);
        $ctrl->setAttype_item($_POST['attype_item']);
        $ctrl->setAttype_id($_POST['attype_id']);
        $ctrl->editAttributeType();
    }
}