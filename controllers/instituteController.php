<?php

include '../models/institute.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Institute();
$From = $_POST;
if (array_key_exists("action", $From)) {
	//institute type
	if ($From['action'] == "getAllInstituteType") {
		$ctrl->getAllInstituteType();
	} else if ($From['action'] == "getInstituteTypeByID") {
		$ctrl->setInsttype_id($From['insttype_id']);
		$ctrl->getInstituteTypeByID();
	} else if ($From['action'] == "cmbInstituteType") {
		$ctrl->cmbInstituteType();
	} else if ($From['action'] == "deleteInstituteType") {
		$ctrl->setInsttype_id($From['insttype_id']);
		$ctrl->deleteInstituteType();
	} else if ($From['action'] == "saveInstituteType") {
		$ctrl->setInsttype_name($From['insttype_name']);
		$ctrl->setInsttype_nature($From['insttype_nature']);
		$ctrl->saveInstituteType();
	} else if ($From['action'] == 'editInstituteType') {
		$ctrl->setInsttype_id($From['insttype_id']);
		$ctrl->setInsttype_name($From['insttype_name']);
		$ctrl->setInsttype_nature($From['insttype_nature']);
		$ctrl->editInstituteType();
	}
	//institute
	else if ($From['action'] == "getAllInstitute") {
		$ctrl->setInst_division($From['inst_division']);
		$ctrl->getAllInstitute();
	} else if ($From['action'] == "getInstituteByID") {
		$ctrl->setInst_id($From['inst_id']);
		$ctrl->getInstituteByID();
	} else if ($From['action'] == "cmbInstitute") {
		$ctrl->setInst_division($From['inst_division']);
		$ctrl->setInst_institutetype($From['inst_institutetype']);
		$ctrl->cmbInstitute();
	} else if ($From['action'] == "cmbInstituteExceptLoggedOne") {
		$ctrl->setInst_division($From['inst_division']);
		$ctrl->setInst_institutetype($From['inst_institutetype']);
		$ctrl->cmbInstituteExceptLoggedOne();
	} else if ($From['action'] == "deleteInstitute") {
		$ctrl->setInst_id($From['inst_id']);
		$ctrl->deleteInstitute();
	} else if ($From['action'] == "saveInstitute") {
		$ctrl->setInst_name($From['inst_name']);
		$ctrl->setInst_cus_id($_POST['inst_cus_id']);
		$ctrl->setInst_address($From['inst_address']);
		$ctrl->setInst_phone($From['inst_phone']);
		$ctrl->setInst_email($From['inst_email']);
		$ctrl->setInst_province($From['inst_province']);
		$ctrl->setInst_zonal($From['inst_zonal']);
		$ctrl->setInst_division($From['inst_division']);
		$ctrl->setInst_institutetype($From['inst_institutetype']);
		$ctrl->setInst_selection_key($From['inst_selection_key']);
		$ctrl->setInst_schtype($_POST['inst_schtype']);
		$ctrl->setInst_schownership($_POST['inst_schownership']);
		$ctrl->setInst_schmedium($_POST['inst_schmedium']);
		$ctrl->setInst_schclassification($_POST['inst_schclassification']);
		$ctrl->setInst_schgrade($_POST['inst_schgrade']);		
		$ctrl->saveInstitute();
	} else if ($From['action'] == 'editInstitute') {
		$ctrl->setInst_name($From['inst_name']);
		$ctrl->setInst_cus_id($_POST['inst_cus_id']);
		$ctrl->setInst_address($From['inst_address']);
		$ctrl->setInst_phone($From['inst_phone']);
		$ctrl->setInst_email($From['inst_email']);
		$ctrl->setInst_province($From['inst_province']);
		$ctrl->setInst_zonal($From['inst_zonal']);
		$ctrl->setInst_division($From['inst_division']);
		$ctrl->setInst_institutetype($From['inst_institutetype']);
		$ctrl->setInst_selection_key($From['inst_selection_key']);
		$ctrl->setInst_schtype($_POST['inst_schtype']);
		$ctrl->setInst_schownership($_POST['inst_schownership']);
		$ctrl->setInst_schmedium($_POST['inst_schmedium']);
		$ctrl->setInst_schclassification($_POST['inst_schclassification']);
		$ctrl->setInst_schgrade($_POST['inst_schgrade']);		
		$ctrl->setInst_id($From['inst_id']);
		$ctrl->editInstitute();
	}

	//school options
	else if ($From['action'] == 'cmbSchoolType') {
		$ctrl->cmbSchoolType();
	} else if ($From['action'] == 'cmbSchoolOwnership') {
		$ctrl->cmbSchoolOwnership();
	} else if ($From['action'] == 'cmbSchoolMedium') {
		$ctrl->cmbSchoolMedium();
	} else if ($From['action'] == 'cmbSchoolClassification') {
		$ctrl->cmbSchoolClassification();
	} else if ($From['action'] == 'cmbSchoolGrade') {
		$ctrl->cmbSchoolGrade();
	}
}