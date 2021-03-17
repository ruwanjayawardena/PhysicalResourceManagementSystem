<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Grn extends ConnectDB {

	const TBL_Grn = 'st_grn';
	const TBL_GrnItem = 'st_grn_item';

	private $grn_id;
	private $grn_type;
	private $grn_custom_no;
	private $grn_supplier;
	private $grn_issue_id;
	private $grn_date;
	private $grn_time;
	private $grn_description;
	private $grn_status;
	private $grn_created_usr;
	private $grn_institute;
	//Grn Item
	private $grtm_id;
	private $grtm_grn_id;
	private $grtm_item;
	private $grtm_item_attribute;
	private $grtm_return_qty;
	private $grtm_qty;
	private $grtm_unitprice;
	private $grtm_description;
	private $grtm_status;

	public function getGrn_institute() {
		return $this->grn_institute;
	}

	public function setGrn_institute($grn_institute) {
		$this->grn_institute = $grn_institute;
	}

	public function getGrn_id() {
		return $this->grn_id;
	}

	public function getGrn_type() {
		return $this->grn_type;
	}

	public function getGrn_custom_no() {
		return $this->grn_custom_no;
	}

	public function getGrn_supplier() {
		return $this->grn_supplier;
	}

	public function getGrn_issue_id() {
		return $this->grn_issue_id;
	}

	public function getGrn_date() {
		return $this->grn_date;
	}

	public function getGrn_time() {
		return $this->grn_time;
	}

	public function getGrn_description() {
		return $this->grn_description;
	}

	public function getGrn_status() {
		return $this->grn_status;
	}

	public function getGrn_created_usr() {
		return $this->grn_created_usr;
	}

	public function getGrtm_id() {
		return $this->grtm_id;
	}

	public function getGrtm_grn_id() {
		return $this->grtm_grn_id;
	}

	public function getGrtm_item() {
		return $this->grtm_item;
	}

	public function getGrtm_item_attribute() {
		return $this->grtm_item_attribute;
	}

	public function getGrtm_return_qty() {
		return $this->grtm_return_qty;
	}

	public function getGrtm_qty() {
		return $this->grtm_qty;
	}

	public function getGrtm_unitprice() {
		return $this->grtm_unitprice;
	}

	public function getGrtm_description() {
		return $this->grtm_description;
	}

	public function getGrtm_status() {
		return $this->grtm_status;
	}

	public function setGrn_id($grn_id) {
		$this->grn_id = $grn_id;
	}

	public function setGrn_type($grn_type) {
		$this->grn_type = $grn_type;
	}

	public function setGrn_custom_no($grn_custom_no) {
		$this->grn_custom_no = $grn_custom_no;
	}

	public function setGrn_supplier($grn_supplier) {
		$this->grn_supplier = $grn_supplier;
	}

	public function setGrn_issue_id($grn_issue_id) {
		$this->grn_issue_id = $grn_issue_id;
	}

	public function setGrn_date($grn_date) {
		$this->grn_date = $grn_date;
	}

	public function setGrn_time($grn_time) {
		$this->grn_time = $grn_time;
	}

	public function setGrn_description($grn_description) {
		$this->grn_description = $grn_description;
	}

	public function setGrn_status($grn_status) {
		$this->grn_status = $grn_status;
	}

	public function setGrn_created_usr($grn_created_usr) {
		$this->grn_created_usr = $grn_created_usr;
	}

	public function setGrtm_id($grtm_id) {
		$this->grtm_id = $grtm_id;
	}

	public function setGrtm_grn_id($grtm_grn_id) {
		$this->grtm_grn_id = $grtm_grn_id;
	}

	public function setGrtm_item($grtm_item) {
		$this->grtm_item = $grtm_item;
	}

	public function setGrtm_item_attribute($grtm_item_attribute) {
		$this->grtm_item_attribute = $grtm_item_attribute;
	}

	public function setGrtm_return_qty($grtm_return_qty) {
		$this->grtm_return_qty = $grtm_return_qty;
	}

	public function setGrtm_qty($grtm_qty) {
		$this->grtm_qty = $grtm_qty;
	}

	public function setGrtm_unitprice($grtm_unitprice) {
		$this->grtm_unitprice = $grtm_unitprice;
	}

	public function setGrtm_description($grtm_description) {
		$this->grtm_description = $grtm_description;
	}

	public function setGrtm_status($grtm_status) {
		$this->grtm_status = $grtm_status;
	}

	public function getAllGrnItemSupplier() {
		$data = array();
		$sql = "SELECT
st_grn_item.grtm_id,
st_grn_item.grtm_grn_id,
st_grn_item.grtm_item,
st_grn_item.grtm_item_attribute,
st_grn_item.grtm_return_qty,
st_grn_item.grtm_qty,
st_grn_item.grtm_unitprice,
st_grn_item.grtm_description,
st_grn_item.grtm_status,
st_item_attribute.at_name,
st_item_attribute.at_price,
st_item.itm_name,
st_item.itm_code,
IFNULL((SELECT
st_mainstock.stk_qty
FROM
st_mainstock
WHERE
st_mainstock.stk_institute = :stk_institute AND
st_mainstock.stk_item = st_grn_item.grtm_item AND
st_mainstock.stk_item_attribute = st_grn_item.grtm_item_attribute),'Stock not Available') AS stk_qty
FROM
st_grn_item
INNER JOIN st_item ON st_grn_item.grtm_item = st_item.itm_id
INNER JOIN st_item_attribute ON st_grn_item.grtm_item_attribute = st_item_attribute.at_id
WHERE
st_grn_item.grtm_grn_id = :grtm_grn_id
ORDER BY
st_grn_item.grtm_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':grtm_grn_id', $this->getGrtm_grn_id(), PDO::PARAM_INT);
			$readstmt->bindParam(':stk_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getAllGrnItemInstitute() {
		$data = array();
		$sql = "SELECT
st_grn_item.grtm_id,
st_grn_item.grtm_grn_id,
st_grn_item.grtm_item,
st_grn_item.grtm_item_attribute,
st_grn_item.grtm_return_qty,
st_grn_item.grtm_qty,
st_grn_item.grtm_unitprice,
st_grn_item.grtm_description,
st_grn_item.grtm_status,
st_item_attribute.at_name,
st_item_attribute.at_price,
st_item.itm_name,
st_item.itm_code,
IFNULL((SELECT
st_mainstock.stk_qty
FROM
st_mainstock
WHERE
st_mainstock.stk_institute = :stk_institute AND
st_mainstock.stk_item = st_grn_item.grtm_item AND
st_mainstock.stk_item_attribute = st_grn_item.grtm_item_attribute),'Stock not Available') AS stk_qty
FROM
st_grn_item
INNER JOIN st_item ON st_grn_item.grtm_item = st_item.itm_id
INNER JOIN st_item_attribute ON st_grn_item.grtm_item_attribute = st_item_attribute.at_id
WHERE
st_grn_item.grtm_grn_id = :grtm_grn_id
ORDER BY
st_grn_item.grtm_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':grtm_grn_id', $this->getGrtm_grn_id(), PDO::PARAM_INT);
			$readstmt->bindParam(':stk_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getAllGrnSupplier() {
		$data = array();
		$sql = "SELECT
st_grn.grn_id,
st_grn.grn_type,
st_grn.grn_institute,
st_grn.grn_custom_no,
st_grn.grn_supplier,
st_grn.grn_issue_id,
st_grn.grn_date,
st_grn.grn_time,
st_grn.grn_description,
st_grn.grn_status,
st_grn.grn_created_usr,
st_supplier.sup_name,
st_supplier.sup_address,
st_supplier.sup_phone,
st_supplier.sup_email
FROM
st_grn
INNER JOIN st_supplier ON st_grn.grn_supplier = st_supplier.sup_id
WHERE
st_grn.grn_institute = :grn_institute AND
st_grn.grn_type = 1
ORDER BY
st_grn.grn_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':grn_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getAllGrnInstitute() {
		$data = array();
		$sql = "SELECT
st_grn.grn_id,
st_grn.grn_type,
st_grn.grn_institute,
st_grn.grn_custom_no,
st_grn.grn_supplier,
st_grn.grn_issue_id,
st_grn.grn_date,
st_grn.grn_time,
st_grn.grn_description,
st_grn.grn_status,
st_grn.grn_created_usr,
st_issue.issu_date,
st_issue.issu_time,
st_issue.issu_custom_issueno,
st_institute.inst_name,
st_institute.inst_address,
st_institute.inst_phone,
st_institute.inst_email,
st_division.div_name,
st_zonal.zol_name,
st_province.prov_name,
st_institute_type.insttype_name
FROM
st_grn
INNER JOIN st_issue ON st_grn.grn_issue_id = st_issue.issu_id
INNER JOIN st_institute ON st_issue.issu_institute = st_institute.inst_id
INNER JOIN st_division ON st_institute.inst_division = st_division.div_id
INNER JOIN st_zonal ON st_division.div_zone = st_zonal.zol_id
INNER JOIN st_province ON st_zonal.zol_province = st_province.prov_id
INNER JOIN st_institute_type ON st_institute.inst_institutetype = st_institute_type.insttype_id
WHERE
st_grn.grn_institute = :grn_institute AND
st_grn.grn_type = 2
ORDER BY
st_grn.grn_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':grn_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

//	public function cmbGrn() {
//		$data = array();
//		$sql = "SELECT
//st_item_attributetype.attype_id,
//st_item_attributetype.attype_name,
//st_item_attributetype.attype_item
//FROM
//st_item_attributetype
//WHERE
//st_item_attributetype.attype_item = :attype_item
//ORDER BY
//st_item_attributetype.attype_name ASC";
//		try {
//			$readstmt = $this->con->prepare($sql);
//			$readstmt->bindParam(':attype_item', $this->getAttype_item(), PDO::PARAM_INT);
//			$readstmt->execute();
//			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
//				$data[] = $row;
//			}
//			echo json_encode($data);
//		} catch (Exception $exc) {
//			echo json_encode($data);
//		}
//	}
	public function getGrnSupplierByID() {
		$data = array();
		$sql = "SELECT
st_grn.grn_id,
st_grn.grn_type,
st_grn.grn_institute,
st_grn.grn_custom_no,
st_grn.grn_supplier,
st_grn.grn_issue_id,
st_grn.grn_date,
st_grn.grn_time,
st_grn.grn_description,
st_grn.grn_status,
st_grn.grn_created_usr,
st_supplier.sup_name,
st_supplier.sup_address,
st_supplier.sup_phone,
st_supplier.sup_email
FROM
st_grn
INNER JOIN st_supplier ON st_grn.grn_supplier = st_supplier.sup_id
WHERE
st_grn.grn_id = :grn_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':grn_id', $this->getGrn_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getGrnInstituteByID() {
		$data = array();
		$sql = "SELECT
st_grn.grn_id,
st_grn.grn_type,
st_grn.grn_institute,
st_grn.grn_custom_no,
st_grn.grn_supplier,
st_grn.grn_issue_id,
st_grn.grn_date,
st_grn.grn_time,
st_grn.grn_description,
st_grn.grn_status,
st_grn.grn_created_usr
FROM
st_grn
WHERE
st_grn.grn_id = 13";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':grn_id', $this->getGrn_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

//	public function getGrnByIDReport() {
//		$data = array();
//		$dataGrn = array();
//		$dataSend = array();
//		$sql_sendInstitue = "SELECT
//st_issue.issu_id,
//st_issue.issu_institute,
//st_issue.issu_send_institute,
//st_issue.issu_custom_issueno,
//st_issue.issu_description,
//st_issue.issu_date,
//st_issue.issu_time,
//st_issue.issu_status,
//st_issue.issu_created_usr,
//st_institute.inst_name AS send_inst_name,
//st_institute.inst_address AS send_inst_address,
//st_institute.inst_phone AS send_inst_phone,
//st_institute.inst_email AS send_inst_email,
//st_division.div_name AS send_div_name,
//st_zonal.zol_name AS send_zol_name,
//st_province.prov_name AS send_prov_name,
//st_institute_type.insttype_name AS send_insttype_name
//FROM
//st_issue
//INNER JOIN st_institute ON st_issue.issu_send_institute = st_institute.inst_id
//INNER JOIN st_division ON st_division.div_id = st_institute.inst_division
//INNER JOIN st_zonal ON st_division.div_zone = st_zonal.zol_id
//INNER JOIN st_province ON st_zonal.zol_province = st_province.prov_id
//INNER JOIN st_institute_type ON st_institute.inst_institutetype = st_institute_type.insttype_id
//WHERE
//st_issue.issu_id = :issu_id";
//		$sql_issueInstitue = "SELECT
//st_institute.inst_name AS issue_inst_name,
//st_institute.inst_address AS issue_inst_address,
//st_institute.inst_phone AS issue_inst_phone,
//st_institute.inst_email AS issue_inst_email,
//st_division.div_name AS issue_div_name,
//st_zonal.zol_name AS issue_zol_name,
//st_province.prov_name AS issue_prov_name,
//st_institute_type.insttype_name AS issue_insttype_name
//FROM
//st_issue
//INNER JOIN st_institute ON st_issue.issu_institute = st_institute.inst_id
//INNER JOIN st_division ON st_institute.inst_division = st_division.div_id
//INNER JOIN st_zonal ON st_institute.inst_zonal = st_zonal.zol_id AND st_division.div_zone = st_zonal.zol_id
//INNER JOIN st_province ON st_institute.inst_province = st_province.prov_id AND st_zonal.zol_province = st_province.prov_id
//INNER JOIN st_institute_type ON st_institute.inst_institutetype = st_institute_type.insttype_id
//WHERE
//st_issue.issu_id = :issu_id";
//		try {
//			$readstmtSend = $this->con->prepare($sql_sendInstitue);
//			$readstmtGrn = $this->con->prepare($sql_issueInstitue);
//			$readstmtSend->bindParam(':issu_id', $this->getIssu_id(), PDO::PARAM_INT);
//			$readstmtGrn->bindParam(':issu_id', $this->getIssu_id(), PDO::PARAM_INT);
//			$readstmtSend->execute();
//			$readstmtGrn->execute();
//			while ($rowSend = $readstmtSend->fetch(PDO::FETCH_ASSOC)) {
//				$dataSend[0] = $rowSend;
//			}
//			while ($rowGrn = $readstmtGrn->fetch(PDO::FETCH_ASSOC)) {
//				$dataGrn[] = $rowGrn;
//			}
//			$data[] = array_merge_recursive($dataSend[0], $dataGrn[0]);
//			echo json_encode($data);
//		} catch (Exception $exc) {
//			echo json_encode($data);
//		}
//	}


	public function getGrnItemSupplierByID() {
		$data = array();
		$sql = "SELECT
st_grn_item.grtm_id,
st_grn_item.grtm_grn_id,
st_grn_item.grtm_item,
st_grn_item.grtm_item_attribute,
st_grn_item.grtm_return_qty,
st_grn_item.grtm_qty,
st_grn_item.grtm_unitprice,
st_grn_item.grtm_description,
st_grn_item.grtm_status,
st_item.itm_maincategory,
st_item.itm_sub1category,
st_item.itm_sub2category,
st_item_attribute.at_attributetype
FROM
st_grn_item
INNER JOIN st_item ON st_grn_item.grtm_item = st_item.itm_id
INNER JOIN st_item_attribute ON st_grn_item.grtm_item_attribute = st_item_attribute.at_id
WHERE
st_grn_item.grtm_id = :grtm_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':grtm_id', $this->getGrtm_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getNextAutoGrnID() {
		$nextid = 0;
		$sql = "SHOW TABLE STATUS LIKE 'st_grn'";
		$readstmt = $this->con->prepare($sql);
		$readstmt->execute();
		while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
			$nextid = $row->Auto_increment;
		}
		$this->setGrn_id($nextid);
	}

	public function completeGrn() {
		$flag = false;
		$sql_grnItem = "SELECT
st_grn_item.grtm_item,
st_grn_item.grtm_item_attribute,
st_grn_item.grtm_qty,
st_grn_item.grtm_unitprice,
st_grn.grn_institute
FROM
st_grn_item
INNER JOIN st_grn ON st_grn_item.grtm_grn_id = st_grn.grn_id
WHERE
st_grn_item.grtm_grn_id = :grtm_grn_id";
//		$sql_updateStock = "UPDATE `st_mainstock` SET `stk_qty`= :stk_qty WHERE (`stk_institute`= :stk_institute) AND (`stk_item` = :stk_item) AND (`stk_item_attribute` = :stk_item_attribute);
		$sql_updateStock = "INSERT INTO `st_mainstock` (`stk_institute`, `stk_item`, `stk_item_attribute`, `stk_qty`,`stk_unitprice`) VALUES (:stk_institute,:stk_item, :stk_item_attribute,:stk_qty,:stk_unitprice) ON DUPLICATE KEY UPDATE `stk_qty` = `stk_qty` + :stk_qty , `stk_unitprice` = :stk_unitprice;";
		try {
			$this->getCon()->beginTransaction();
			$readGrnItem = $this->con->prepare($sql_grnItem);
			$readGrnItem->bindParam(':grtm_grn_id', $this->getGrn_id(), PDO::PARAM_INT);
			$readGrnItem->execute();
			while ($row = $readGrnItem->fetch(PDO::FETCH_OBJ)) {
				$updatestmt = $this->con->prepare($sql_updateStock);
				$updatestmt->bindParam(':stk_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
				$updatestmt->bindParam(':stk_item', $row->grtm_item, PDO::PARAM_INT);
				$updatestmt->bindParam(':stk_item_attribute', $row->grtm_item_attribute, PDO::PARAM_INT);
				$updatestmt->bindParam(':stk_qty', $row->grtm_qty, PDO::PARAM_INT);
				$updatestmt->bindParam(':stk_unitprice', $row->grtm_unitprice, PDO::PARAM_STR);
				$updatestmt->execute();
				$flag = true;
			}
			if ($flag) {
				$this->getCon()->commit();
				$this->setGrn_status(1);
				$status = $this->changeGrnStatus();
				if ($status) {
					echo json_encode(array("msgType" => 1, "msg" => "Successfully Completed"));
				}
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Processing Failed ! Try Again"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function completeGrnInstitute() {
		$flag = false;
		$flag2 = false;
		$flag3 = false;
		$sql_grnItem = "SELECT
st_grn_item.grtm_item,
st_grn_item.grtm_item_attribute,
st_grn_item.grtm_qty,
st_grn_item.grtm_unitprice,
st_grn.grn_institute,
st_grn_item.grtm_return_qty,
st_grn_item.grtm_status,
st_grn_item.grtm_description,
st_grn_item.grtm_grn_id,
st_grn_item.grtm_id
FROM
st_grn_item
INNER JOIN st_grn ON st_grn_item.grtm_grn_id = st_grn.grn_id
WHERE
st_grn_item.grtm_grn_id = :grtm_grn_id";
		$sql_issueItem = "SELECT
st_issue_item.istm_id
FROM
st_issue_item
WHERE
st_issue_item.istm_issue_id = :istm_issue_id";

		$sql_updateStock = "INSERT INTO `st_mainstock` (`stk_institute`, `stk_item`, `stk_item_attribute`, `stk_qty`) VALUES (:stk_institute,:stk_item, :stk_item_attribute,:stk_qty) ON DUPLICATE KEY UPDATE `stk_qty` = `stk_qty` + :stk_qty";

		$sql_updateIssueItem = "UPDATE `st_issue_item` SET `istm_status`= :istm_status WHERE (`istm_item`= :istm_item) AND (`istm_item_attribute`= :istm_item_attribute) AND (`istm_issue_id`= :istm_issue_id);";

		$sql_updateIssue = "UPDATE `st_issue` SET `issu_status`=3 WHERE (`issu_id`=:issu_id);";
		try {
			$this->getCon()->beginTransaction();
			$readGrnItem = $this->con->prepare($sql_grnItem);
			$readGrnItem->bindParam(':grtm_grn_id', $this->getGrn_id(), PDO::PARAM_INT);
			$readGrnItem->execute();
			//get issue item count
			$readIssuItem = $this->con->prepare($sql_issueItem);
			$readIssuItem->bindParam(':istm_issue_id', $this->getGrn_issue_id(), PDO::PARAM_INT);
			$readIssuItem->execute();
			$grnaddeditemcount = $readGrnItem->rowCount();
			$issueitemcount = $readIssuItem->rowCount();

			if ($issueitemcount == $grnaddeditemcount) {
				while ($row = $readGrnItem->fetch(PDO::FETCH_OBJ)) {
					$updatestmt = $this->con->prepare($sql_updateStock);
					$updatestmt->bindParam(':stk_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
					$updatestmt->bindParam(':stk_item', $row->grtm_item, PDO::PARAM_INT);
					$updatestmt->bindParam(':stk_item_attribute', $row->grtm_item_attribute, PDO::PARAM_INT);
					$updatestmt->bindParam(':stk_qty', $row->grtm_qty, PDO::PARAM_INT);
					$flag = $updatestmt->execute();
					//update issue
					$updatestmt2 = $this->con->prepare($sql_updateIssueItem);
					$updatestmt2->bindParam(':istm_status', $row->grtm_status, PDO::PARAM_INT);
					$updatestmt2->bindParam(':istm_item', $row->grtm_item, PDO::PARAM_INT);
					$updatestmt2->bindParam(':istm_item_attribute', $row->grtm_item_attribute, PDO::PARAM_INT);
					$updatestmt2->bindParam(':istm_issue_id', $this->getGrn_issue_id(), PDO::PARAM_INT);
					$flag2 = $updatestmt2->execute();
				}

				$updatestmt3 = $this->con->prepare($sql_updateIssue);
				$updatestmt3->bindParam(':issu_id', $this->getGrn_issue_id(), PDO::PARAM_INT);
				$flag3 = $updatestmt3->execute();
				
				if ($flag && $flag2 && $flag3) {
					$this->getCon()->commit();
					$this->setGrn_status(1);
					$status = $this->changeGrnStatus();
					if ($status) {
						echo json_encode(array("msgType" => 1, "msg" => "Successfully Completed"));
					}
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Processing Failed ! Try Again"));
				}
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "For Complete this process need to take any of action for all issued items"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function saveGrnSupplier() {
		$this->getNextAutoGrnID();
		$sql = "INSERT INTO `st_grn` (`grn_type`, `grn_institute`, `grn_custom_no`, `grn_supplier`,`grn_date`, `grn_time`, `grn_description`, `grn_created_usr`) VALUES (:grn_type,:grn_institute,:grn_custom_no,:grn_supplier,:grn_date,:grn_time,:grn_description,:grn_created_usr);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':grn_type', $this->getGrn_type(), PDO::PARAM_INT);
			$createstmt->bindParam(':grn_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$createstmt->bindParam(':grn_custom_no', $this->getGrn_custom_no(), PDO::PARAM_STR);
			$createstmt->bindParam(':grn_supplier', $this->getGrn_supplier(), PDO::PARAM_INT);
			$createstmt->bindParam(':grn_description', $this->getGrn_description(), PDO::PARAM_STR);
			$createstmt->bindParam(':grn_date', date("Y-m-d"), PDO::PARAM_STR);
			$createstmt->bindParam(':grn_time', date("H:i:s"), PDO::PARAM_STR);
			$createstmt->bindParam(':grn_created_usr', $_SESSION['usr_id'], PDO::PARAM_STR);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully saved.Please wait for continue to next item adding step", "grn_id" => $this->getGrn_id()));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate grn no.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function saveGrnInstitute() {
		$this->getNextAutoGrnID();
		$sql = "INSERT INTO `st_grn` (`grn_type`, `grn_institute`, `grn_custom_no`, `grn_issue_id`,`grn_date`, `grn_time`, `grn_description`, `grn_created_usr`) VALUES (:grn_type,:grn_institute,:grn_custom_no,:grn_issue_id,:grn_date,:grn_time,:grn_description,:grn_created_usr);";
		$sql_updateIssue = "UPDATE `st_issue` SET `issu_status`=2 WHERE (`issu_id`=:issu_id);";
		try {
			$this->getCon()->beginTransaction();
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':grn_type', $this->getGrn_type(), PDO::PARAM_INT);
			$createstmt->bindParam(':grn_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$createstmt->bindParam(':grn_custom_no', $this->getGrn_custom_no(), PDO::PARAM_STR);
			$createstmt->bindParam(':grn_issue_id', $this->getGrn_issue_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':grn_description', $this->getGrn_description(), PDO::PARAM_STR);
			$createstmt->bindParam(':grn_date', date("Y-m-d"), PDO::PARAM_STR);
			$createstmt->bindParam(':grn_time', date("H:i:s"), PDO::PARAM_STR);
			$createstmt->bindParam(':grn_created_usr', $_SESSION['usr_id'], PDO::PARAM_STR);
			if ($createstmt->execute()) {
				//update issuing status 2- accepted & preparing
				$createstmt2 = $this->con->prepare($sql_updateIssue);
				$createstmt2->bindParam(':issu_id', $this->getGrn_issue_id(), PDO::PARAM_INT);
				if ($createstmt2->execute()) {
					$this->getCon()->commit();
					echo json_encode(array("msgType" => 1, "msg" => "Successfully saved.Please wait for continue to next item adding step", "grn_id" => $this->getGrn_id()));
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
				}
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate grn no.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function saveGrnItemSupplier() {
		$sql = "INSERT INTO `st_grn_item` (`grtm_grn_id`, `grtm_item`, `grtm_item_attribute`,`grtm_qty`, `grtm_unitprice`, `grtm_description`) VALUES (:grtm_grn_id, :grtm_item, :grtm_item_attribute, :grtm_qty, :grtm_unitprice, :grtm_description);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':grtm_grn_id', $this->getGrtm_grn_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':grtm_item', $this->getGrtm_item(), PDO::PARAM_INT);
			$createstmt->bindParam(':grtm_item_attribute', $this->getGrtm_item_attribute(), PDO::PARAM_INT);
			$createstmt->bindParam(':grtm_qty', $this->getGrtm_qty(), PDO::PARAM_INT);
			$createstmt->bindParam(':grtm_unitprice', $this->getGrtm_unitprice(), PDO::PARAM_STR);
			$createstmt->bindParam(':grtm_description', $this->getGrtm_description(), PDO::PARAM_STR);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Item Added."));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! Item adding failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered Item was duplicated I.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function saveGrnItemInstitute($selected_issue_items) {
		$flag = false;
		$newarray = array();
		$explodeMainAr = explode(",", $selected_issue_items);
		foreach ($explodeMainAr as $index => $explodeMainArStr) {
			$explodeSubAr = explode('-', $explodeMainArStr);
			$newarray[$index]['grtm_item'] = $explodeSubAr[0];
			$newarray[$index]['grtm_item_attribute'] = $explodeSubAr[1];
			$newarray[$index]['grtm_status'] = $explodeSubAr[2];
			$newarray[$index]['grtm_qty'] = $explodeSubAr[3];
			$newarray[$index]['grtm_return_qty'] = $explodeSubAr[4];
			$newarray[$index]['grtm_description'] = $explodeSubAr[5];
		}

		$sql = "INSERT INTO `st_grn_item` (`grtm_grn_id`, `grtm_item`, `grtm_item_attribute`,`grtm_qty`, `grtm_return_qty`, `grtm_description`,`grtm_status`) VALUES (:grtm_grn_id, :grtm_item, :grtm_item_attribute, :grtm_qty, :grtm_return_qty, :grtm_description,:grtm_status);";
		try {
			$this->getCon()->beginTransaction();
			foreach ($newarray as $receiveItem) {
				$createstmt = $this->con->prepare($sql);
				//remove "" mark from string
				$grtm_description = sprintf("%s", $receiveItem['grtm_description']);
				$grtm_description = substr($grtm_description, 1, -1);
				//end of string formating
				$createstmt->bindParam(':grtm_grn_id', $this->getGrtm_grn_id(), PDO::PARAM_INT);
				$createstmt->bindParam(':grtm_item', $receiveItem['grtm_item'], PDO::PARAM_INT);
				$createstmt->bindParam(':grtm_item_attribute', $receiveItem['grtm_item_attribute'], PDO::PARAM_INT);
				$createstmt->bindParam(':grtm_qty', $receiveItem['grtm_qty'], PDO::PARAM_INT);
				$createstmt->bindParam(':grtm_return_qty', $receiveItem['grtm_return_qty'], PDO::PARAM_INT);
				$createstmt->bindParam(':grtm_description', $grtm_description, PDO::PARAM_STR);
				$createstmt->bindParam(':grtm_status', $receiveItem['grtm_status'], PDO::PARAM_STR);
				$flag = $createstmt->execute();
			}
			if ($flag) {
				$this->getCon()->commit();
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Items Added."));
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! Items adding failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered Item was duplicated I.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function changeGrnStatus() {
		$sql = "UPDATE `st_grn` SET `grn_status`= :grn_status WHERE (`grn_id`=:grn_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':grn_status', $this->getGrn_status(), PDO::PARAM_INT);
			$createstmt->bindParam(':grn_id', $this->getGrn_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				//0 - preparing, 1 - completed & stock update
				return true;
			} else {
				return false;
			}
		} catch (Exception $exc) {
			return false;
		}
	}

	public function deleteGrn() {
		$sql = "DELETE FROM `st_grn` WHERE (`grn_id`=:grn_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':grn_id', $this->getGrn_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function deleteGrnItem() {
		$sql = "DELETE FROM `st_grn_item` WHERE (`grtm_id`=:grtm_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':grtm_id', $this->getGrtm_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//	public function editGrn() {
//		$sql = "UPDATE `st_issue` SET  `issu_send_institute`=:issu_send_institute, `issu_custom_issueno`=:issu_custom_issueno, `issu_description`=:issu_description, `issu_date`=:issu_date, `issu_time`=:issu_time, `issu_created_usr`=:issu_created_usr WHERE (`issu_id` = :issu_id) AND (`issu_status` = 0);";
//		try {
//			$createstmt = $this->con->prepare($sql);
//			$createstmt->bindParam(':issu_id', $this->getIssu_id(), PDO::PARAM_INT);
//			$createstmt->bindParam(':issu_send_institute', $this->getIssu_send_institute(), PDO::PARAM_INT);
//			$createstmt->bindParam(':issu_custom_issueno', $this->getIssu_custom_issueno(), PDO::PARAM_STR);
//			$createstmt->bindParam(':issu_description', $this->getIssu_description(), PDO::PARAM_STR);
//			$createstmt->bindParam(':issu_date', date("Y-m-d"), PDO::PARAM_STR);
//			$createstmt->bindParam(':issu_time', date("H:i:s"), PDO::PARAM_STR);
//			$createstmt->bindParam(':issu_created_usr', $_SESSION['usr_id'], PDO::PARAM_STR);
//			if ($createstmt->execute()) {
//				echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
//			} else {
//				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
//			}
//		} catch (Exception $exc) {
//			if ($exc->getCode() == 23000) {
//				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate attribute name.Please check and change it"));
//			} else {
//				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
//			}
//		}
//	}

	public function editGrnItemSupplier() {
		$sql = "UPDATE `st_grn_item` SET `grtm_item`=:grtm_item, `grtm_item_attribute`=:grtm_item_attribute, `grtm_qty`=:grtm_qty, `grtm_unitprice`=:grtm_unitprice, `grtm_description`=:grtm_description WHERE (`grtm_id` = :grtm_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':grtm_id', $this->getGrtm_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':grtm_description', $this->getGrtm_description(), PDO::PARAM_STR);
			$createstmt->bindParam(':grtm_unitprice', $this->getGrtm_unitprice(), PDO::PARAM_STR);
			$createstmt->bindParam(':grtm_qty', $this->getGrtm_qty(), PDO::PARAM_INT);
			$createstmt->bindParam(':grtm_item_attribute', $this->getGrtm_item_attribute(), PDO::PARAM_INT);
			$createstmt->bindParam(':grtm_item', $this->getGrtm_item(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Item updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered Item was duplicated.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

}
