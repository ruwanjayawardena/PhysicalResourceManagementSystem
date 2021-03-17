<?php

include '../models/grn.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Grn();
if (array_key_exists("action", $_POST)) {
	if ($_POST['action'] == "saveGrnSupplier") {
		$ctrl->setGrn_type($_POST['grn_type']);
		$ctrl->setGrn_custom_no($_POST['grn_custom_no']);
		$ctrl->setGrn_supplier($_POST['grn_supplier']);
		$ctrl->setGrn_description($_POST['grn_description']);
		$ctrl->saveGrnSupplier();
	} else if ($_POST['action'] == "saveGrnInstitute") {
		$ctrl->setGrn_type($_POST['grn_type']);
		$ctrl->setGrn_custom_no($_POST['grn_custom_no']);
		$ctrl->setGrn_issue_id($_POST['grn_issue_id']);
		$ctrl->setGrn_description($_POST['grn_description']);
		$ctrl->saveGrnInstitute();
	} 
	else if ($_POST['action'] == "getGrnSupplierByID") {
		$ctrl->setGrn_id($_POST['grn_id']);
		$ctrl->getGrnSupplierByID();
	}
	else if ($_POST['action'] == "getGrnInstituteByID") {
		$ctrl->setGrn_id($_POST['grn_id']);
		$ctrl->getGrnInstituteByID();
	}
//	else if ($_POST['action'] == "getGrnByIDReport") {
//		$ctrl->setIssu_id($_POST['issu_id']);
//		$ctrl->getGrnByIDReport();
//	} 
	else if ($_POST['action'] == "saveGrnItemSupplier") {
		$ctrl->setGrtm_description($_POST['grtm_description']);
		$ctrl->setGrtm_unitprice($_POST['grtm_unitprice']);
		$ctrl->setGrtm_qty($_POST['grtm_qty']);
		$ctrl->setGrtm_item($_POST['grtm_item']);
		$ctrl->setGrtm_item_attribute($_POST['grtm_item_attribute']);
		$ctrl->setGrtm_grn_id($_POST['grtm_grn_id']);
		$ctrl->saveGrnItemSupplier();
	} else if ($_POST['action'] == "saveGrnItemInstitute") {
		$ctrl->setGrtm_grn_id($_POST['grtm_grn_id']);
		$ctrl->saveGrnItemInstitute($_POST['selected_issue_items']);
	} else if ($_POST['action'] == "deleteGrnItem") {
		$ctrl->setGrtm_id($_POST['grtm_id']);
		$ctrl->deleteGrnItem();
	} else if ($_POST['action'] == "deleteGrn") {
		$ctrl->setGrn_id($_POST['grn_id']);
		$ctrl->deleteGrn();
	} else if ($_POST['action'] == "editGrnItemSupplier") {
		$ctrl->setGrtm_description($_POST['grtm_description']);
		$ctrl->setGrtm_unitprice($_POST['grtm_unitprice']);
		$ctrl->setGrtm_qty($_POST['grtm_qty']);
		$ctrl->setGrtm_item($_POST['grtm_item']);
		$ctrl->setGrtm_item_attribute($_POST['grtm_item_attribute']);
		$ctrl->setGrtm_id($_POST['grtm_id']);
		$ctrl->editGrnItemSupplier();
	} 
	else if ($_POST['action'] == "getAllGrnItemSupplier") {
		$ctrl->setGrtm_grn_id($_POST['grtm_grn_id']);
		$ctrl->getAllGrnItemSupplier();
	} 
	else if ($_POST['action'] == "getAllGrnItemInstitute") {
		$ctrl->setGrtm_grn_id($_POST['grtm_grn_id']);
		$ctrl->getAllGrnItemInstitute();
	} 
	else if ($_POST['action'] == "getAllGrnSupplier") {
		$ctrl->getAllGrnSupplier();
	} else if ($_POST['action'] == "getAllGrnInstitute") {
		$ctrl->getAllGrnInstitute();
	} 
	else if ($_POST['action'] == "getGrnItemSupplierByID") {
		$ctrl->setGrtm_id($_POST['grtm_id']);
		$ctrl->getGrnItemSupplierByID();
	}	
	else if ($_POST['action'] == "completeGrn") {
		$ctrl->setGrn_id($_POST['grn_id']);
		$ctrl->completeGrn();
	}
	else if ($_POST['action'] == "completeGrnInstitute") {
		$ctrl->setGrn_id($_POST['grn_id']);
		$ctrl->setGrn_issue_id($_POST['grn_issue_id']);
		$ctrl->completeGrnInstitute();
	}
}