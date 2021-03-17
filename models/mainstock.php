<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class MainStock extends ConnectDB {

	const TBL_MainStock = 'st_mainstock';

	private $flag = false;
	private $stk_id;
	private $stk_institute;
	private $stk_item;
	private $stk_item_attribute;
	private $stk_qty;

	public function getFlag() {
		return $this->flag;
	}

	public function getStk_id() {
		return $this->stk_id;
	}

	public function getStk_institute() {
		return $this->stk_institute;
	}

	public function getStk_item() {
		return $this->stk_item;
	}

	public function getStk_item_attribute() {
		return $this->stk_item_attribute;
	}

	public function getStk_qty() {
		return $this->stk_qty;
	}

	public function setFlag($flag) {
		$this->flag = $flag;
	}

	public function setStk_id($stk_id) {
		$this->stk_id = $stk_id;
	}

	public function setStk_institute($stk_institute) {
		$this->stk_institute = $stk_institute;
	}

	public function setStk_item($stk_item) {
		$this->stk_item = $stk_item;
	}

	public function setStk_item_attribute($stk_item_attribute) {
		$this->stk_item_attribute = $stk_item_attribute;
	}

	public function setStk_qty($stk_qty) {
		$this->stk_qty = $stk_qty;
	}

	public function getAllMainStock() {
		$data = array();
		$sql = "SELECT
st_mainstock.stk_id,
st_mainstock.stk_institute,
st_mainstock.stk_item,
st_mainstock.stk_item_attribute,
st_mainstock.stk_qty,
st_item_attribute.at_price,
st_item_attribute.at_name,
st_item_attribute.at_attributetype,
st_item.itm_name,
st_item.itm_maincategory,
st_item.itm_sub1category,
st_item.itm_sub2category
FROM
st_mainstock
INNER JOIN st_item_attribute ON st_mainstock.stk_item_attribute = st_item_attribute.at_id
INNER JOIN st_item ON st_mainstock.stk_item = st_item.itm_id
WHERE
st_mainstock.stk_institute = " . $_SESSION['usrcat_institute'] . "
ORDER BY
st_mainstock.stk_id DESC";
//		$sql = "SELECT
//st_mainstock.stk_id,
//st_mainstock.stk_institute,
//st_mainstock.stk_item,
//st_mainstock.stk_item_attribute,
//st_mainstock.stk_qty,
//st_item_attribute.at_price,
//st_item_attribute.at_name,
//st_item_attribute.at_attributetype,
//st_item.itm_name
//FROM
//st_mainstock
//INNER JOIN st_item_attribute ON st_mainstock.stk_item_attribute = st_item_attribute.at_id
//INNER JOIN st_item ON st_mainstock.stk_item = st_item.itm_id
//WHERE
//st_mainstock.stk_item = :stk_item AND
//st_mainstock.stk_institute = " . $_SESSION['usrcat_institute'] . "
//ORDER BY
//st_mainstock.stk_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
//			$readstmt->bindParam(':stk_item', $this->getStk_item(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}
	
	public function getAllMainStockFormat2() {
		$data = array();
		$sql = "SELECT
st_mainstock.stk_id,
st_mainstock.stk_institute,
st_mainstock.stk_item,
st_mainstock.stk_item_attribute,
st_mainstock.stk_qty,
GROUP_CONCAT(st_item_attribute.at_name SEPARATOR ' | ') AS attributes,
st_item.itm_name,
st_item.itm_maincategory,
st_item.itm_sub1category,
st_item.itm_sub2category
FROM
st_mainstock
INNER JOIN st_item_attribute ON st_mainstock.stk_item_attribute = st_item_attribute.at_id
INNER JOIN st_item ON st_mainstock.stk_item = st_item.itm_id
WHERE
st_mainstock.stk_institute = " . $_SESSION['usrcat_institute'] . "
GROUP BY
st_mainstock.stk_item
ORDER BY
st_mainstock.stk_id DESC";	
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}
	
	public function getAllMainStockFormatCentralized() {
		$data = array();
		$sql = "SELECT
st_mainstock.stk_id,
st_mainstock.stk_institute,
st_mainstock.stk_item,
st_mainstock.stk_item_attribute,
st_mainstock.stk_qty,
GROUP_CONCAT(st_item_attribute.at_name SEPARATOR ' | ') AS attributes,
st_item.itm_name,
st_item.itm_maincategory,
st_item.itm_sub1category,
st_item.itm_sub2category,
st_institute.inst_name,
st_institute_type.insttype_name,
st_institute_type.insttype_nature,
st_institute.inst_province,
st_institute.inst_zonal,
st_institute.inst_division,
st_institute.inst_institutetype
FROM
st_mainstock
INNER JOIN st_item_attribute ON st_mainstock.stk_item_attribute = st_item_attribute.at_id
INNER JOIN st_item ON st_mainstock.stk_item = st_item.itm_id
INNER JOIN st_institute ON st_mainstock.stk_institute = st_institute.inst_id
INNER JOIN st_institute_type ON st_institute.inst_institutetype = st_institute_type.insttype_id
GROUP BY
st_mainstock.stk_item
ORDER BY
st_mainstock.stk_id DESC";	
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getMainStockByID() {
		$data = array();
		$sql = "SELECT
st_mainstock.stk_id,
st_mainstock.stk_institute,
st_mainstock.stk_item,
st_mainstock.stk_item_attribute,
st_mainstock.stk_qty,
st_item_attribute.at_price,
st_item_attribute.at_name,
st_item_attribute.at_attributetype
FROM
st_mainstock
INNER JOIN st_item_attribute ON st_mainstock.stk_item_attribute = st_item_attribute.at_id
WHERE
st_mainstock.stk_id = :stk_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':stk_id', $this->getStk_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getAvailableItemQTY() {
		$stk_qty = 0;
		$sql = "SELECT
st_mainstock.stk_qty
FROM
st_mainstock
WHERE
st_mainstock.stk_institute = :stk_institute AND
st_mainstock.stk_item = :stk_item AND
st_mainstock.stk_item_attribute = :stk_item_attribute";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':stk_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->bindParam(':stk_item', $this->getStk_item(), PDO::PARAM_INT);
			$readstmt->bindParam(':stk_item_attribute', $this->getStk_item_attribute(), PDO::PARAM_INT);
			$readstmt->execute();
			$count = $readstmt->rowCount();
			if ($count == 0) {
				$stk_qty = 'Not available Stock';
			} else {
				while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
					$stk_qty = $row->stk_qty;
				}
			}
			echo $stk_qty;
		} catch (Exception $exc) {
			echo $stk_qty;
		}
	}

	public function saveMainStock() {
		$sql = "INSERT INTO `st_mainstock` (`stk_institute`, `stk_item`, `stk_item_attribute`, `stk_qty`) VALUES (:stk_institute, :stk_item, :stk_item_attribute, :stk_qty);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':stk_institute', $this->getStk_institute(), PDO::PARAM_INT);
			$createstmt->bindParam(':stk_item', $this->getStk_item(), PDO::PARAM_STR);
			$createstmt->bindParam(':stk_item_attribute', $this->getStk_item_attribute(), PDO::PARAM_INT);
			$createstmt->bindParam(':stk_qty', $this->getStk_qty(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate entry.Please check and resolve it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function deleteMainStock() {
		$sql = "DELETE FROM `st_mainstock` WHERE (`stk_id`=:stk_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':stk_id', $this->getStk_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function editMainStock() {
		$sql = "UPDATE `st_mainstock` SET `stk_institute`=:stk_institute, `stk_item`=:stk_item, `stk_item_attribute`=:stk_item_attribute, `stk_qty`=:stk_qty WHERE (`stk_id` = :stk_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':stk_institute', $this->getStk_institute(), PDO::PARAM_INT);
			$createstmt->bindParam(':stk_item', $this->getStk_item(), PDO::PARAM_STR);
			$createstmt->bindParam(':stk_item_attribute', $this->getStk_item_attribute(), PDO::PARAM_INT);
			$createstmt->bindParam(':stk_qty', $this->getStk_qty(), PDO::PARAM_INT);
			$createstmt->bindParam(':stk_id', $this->getStk_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate entry.Please check and resolve it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

}
