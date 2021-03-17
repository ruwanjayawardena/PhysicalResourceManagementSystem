<?php

include '../models/supplier.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Supplier();
if (array_key_exists("action", $_POST)) {
	if ($_POST['action'] == "getAllSupplier") {
		$ctrl->getAllSupplier();
	} else if ($_POST['action'] == "getSupplierByID") {
		$ctrl->setSup_id($_POST['sup_id']);
		$ctrl->getSupplierByID();
	} else if ($_POST['action'] == "cmbSupplier") {
		$ctrl->cmbSupplier();
	} else if ($_POST['action'] == "deleteSupplier") {
		$ctrl->setSup_id($_POST['sup_id']);
		$ctrl->deleteSupplier();
	} else if ($_POST['action'] == "saveSupplier") {
		$ctrl->setSup_name($_POST['sup_name']);
		$ctrl->setSup_phone($_POST['sup_phone']);
		$ctrl->setSup_email($_POST['sup_email']);
		$ctrl->setSup_address($_POST['sup_address']);
		$ctrl->saveSupplier();
	} else if ($_POST['action'] == 'editSupplier') {
		$ctrl->setSup_name($_POST['sup_name']);
		$ctrl->setSup_phone($_POST['sup_phone']);
		$ctrl->setSup_email($_POST['sup_email']);
		$ctrl->setSup_address($_POST['sup_address']);
		$ctrl->setSup_id($_POST['sup_id']);
		$ctrl->editSupplier();
	}
	//supplier goods
	if ($_POST['action'] == "getAllSupplierGoods") {
		$ctrl->setGd_supplier($_POST['gd_supplier']);
		$ctrl->getAllSupplierGoods();
	} else if ($_POST['action'] == "getSupplierGoodsByID") {
		$ctrl->setGd_id($_POST['gd_id']);
		$ctrl->getSupplierGoodsByID();
	} else if ($_POST['action'] == "cmbSupplierGoods") {
		$ctrl->setGd_supplier($_POST['gd_supplier']);
		$ctrl->cmbSupplierGoods();
	} else if ($_POST['action'] == "deleteSupplierGoods") {
		$ctrl->setGd_id($_POST['gd_id']);
		$ctrl->deleteSupplierGoods();
	} else if ($_POST['action'] == "saveSupplierGoods") {
		$ctrl->setGd_supplier($_POST['gd_supplier']);
		$ctrl->setGd_name($_POST['gd_name']);
		$ctrl->saveSupplierGoods();
	} else if ($_POST['action'] == 'editSupplierGoods') {
		$ctrl->setGd_supplier($_POST['gd_supplier']);
		$ctrl->setGd_name($_POST['gd_name']);
		$ctrl->setGd_id($_POST['gd_id']);
		$ctrl->editSupplierGoods();
	}
}