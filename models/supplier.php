<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Supplier extends ConnectDB {

	const TBL_Supplier = 'st_supplier';

	private $flag = false;
	private $sup_id;
	private $sup_institute;
	private $sup_name;
	private $sup_address;
	private $sup_phone;
	private $sup_email;
	private $sup_created_usr;
	//supplier goods
	private $gd_id;
	private $gd_supplier;
	private $gd_name;	
	

	public function getSup_id() {
		return $this->sup_id;
	}

	public function getSup_institute() {
		return $this->sup_institute;
	}

	public function getSup_name() {
		return $this->sup_name;
	}

	public function getSup_address() {
		return $this->sup_address;
	}

	public function getSup_phone() {
		return $this->sup_phone;
	}

	public function getSup_email() {
		return $this->sup_email;
	}

	public function getSup_created_usr() {
		return $this->sup_created_usr;
	}

	public function setSup_id($sup_id) {
		$this->sup_id = $sup_id;
	}

	public function setSup_institute($sup_institute) {
		$this->sup_institute = $sup_institute;
	}

	public function setSup_name($sup_name) {
		$this->sup_name = $sup_name;
	}

	public function setSup_address($sup_address) {
		$this->sup_address = $sup_address;
	}

	public function setSup_phone($sup_phone) {
		$this->sup_phone = $sup_phone;
	}

	public function setSup_email($sup_email) {
		$this->sup_email = $sup_email;
	}

	public function setSup_created_usr($sup_created_usr) {
		$this->sup_created_usr = $sup_created_usr;
	}
	
	//supplier goods
	public function getFlag() {
		return $this->flag;
	}

	public function getGd_id() {
		return $this->gd_id;
	}

	public function getGd_supplier() {
		return $this->gd_supplier;
	}

	public function getGd_name() {
		return $this->gd_name;
	}

	public function setFlag($flag) {
		$this->flag = $flag;
	}

	public function setGd_id($gd_id) {
		$this->gd_id = $gd_id;
	}

	public function setGd_supplier($gd_supplier) {
		$this->gd_supplier = $gd_supplier;
	}

	public function setGd_name($gd_name) {
		$this->gd_name = $gd_name;
	}
	
	public function getAllSupplier() {
		$data = array();
		$sql = "SELECT
st_supplier.sup_id,
st_supplier.sup_institute,
st_supplier.sup_name,
st_supplier.sup_address,
st_supplier.sup_phone,
st_supplier.sup_email,
st_supplier.sup_created_usr
FROM
st_supplier
WHERE
st_supplier.sup_institute = " . $_SESSION['usrcat_institute'] . "
ORDER BY
st_supplier.sup_id DESC";
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
	
	public function getAllSupplierGoods() {
		$data = array();
		$sql = "SELECT
st_supplier_good.gd_id,
st_supplier_good.gd_supplier,
st_supplier_good.gd_name
FROM
st_supplier_good
WHERE
st_supplier_good.gd_supplier = :gd_supplier
ORDER BY
st_supplier_good.gd_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':gd_supplier', $this->getGd_supplier(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function cmbSupplier() {
		$data = array();
		$sql = "SELECT
st_supplier.sup_id,
st_supplier.sup_institute,
st_supplier.sup_name,
st_supplier.sup_address,
st_supplier.sup_phone,
st_supplier.sup_email,
st_supplier.sup_created_usr
FROM
st_supplier
WHERE
st_supplier.sup_institute = " . $_SESSION['usrcat_institute'] . "
ORDER BY
st_supplier.sup_name ASC";
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
	
	public function cmbSupplierGoods() {
		$data = array();
		$sql = "SELECT
st_supplier_good.gd_id,
st_supplier_good.gd_supplier,
st_supplier_good.gd_name
FROM
st_supplier_good
WHERE
st_supplier_good.gd_supplier = :gd_supplier
ORDER BY
st_supplier_good.gd_name ASC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':gd_supplier', $this->getGd_supplier(), PDO::PARAM_INT);
			$readstmt->execute();			
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getSupplierByID() {
		$data = array();
		$sql = "SELECT
st_supplier.sup_id,
st_supplier.sup_institute,
st_supplier.sup_name,
st_supplier.sup_address,
st_supplier.sup_phone,
st_supplier.sup_email,
st_supplier.sup_created_usr
FROM
st_supplier
WHERE
st_supplier.sup_id = :sup_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':sup_id', $this->getSup_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}
	
	public function getSupplierGoodsByID() {
		$data = array();
		$sql = "SELECT
st_supplier_good.gd_id,
st_supplier_good.gd_supplier,
st_supplier_good.gd_name
FROM
st_supplier_good
WHERE
st_supplier_good.gd_id = :gd_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':gd_id', $this->getGd_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function saveSupplier() {
		$sql = "INSERT INTO `st_supplier` (`sup_institute`, `sup_name`, `sup_address`, `sup_phone`, `sup_email`, `sup_created_usr`) VALUES (:sup_institute, :sup_name, :sup_address, :sup_phone, :sup_email, :sup_created_usr);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':sup_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$createstmt->bindParam(':sup_name', $this->getSup_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':sup_address', $this->getSup_address(), PDO::PARAM_STR);
			$createstmt->bindParam(':sup_phone', $this->getSup_phone(), PDO::PARAM_STR);
			$createstmt->bindParam(':sup_email', $this->getSup_email(), PDO::PARAM_STR);
			$createstmt->bindParam(':sup_created_usr', $_SESSION['usr_id'], PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate supplier name.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}
	
	public function saveSupplierGoods() {
		$sql = "INSERT INTO `st_supplier_good` (`gd_supplier`, `gd_name`) VALUES (:gd_supplier, :gd_name);";
		try {
			$createstmt = $this->con->prepare($sql);			
			$createstmt->bindParam(':gd_supplier', $this->getGd_supplier(), PDO::PARAM_INT);
			$createstmt->bindParam(':gd_name', $this->getGd_name(), PDO::PARAM_STR);			
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate supplier good name.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function deleteSupplier() {
		$sql = "DELETE FROM `st_supplier` WHERE (`sup_id`=:sup_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':sup_id', $this->getSup_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}
	
	public function deleteSupplierGoods() {
		$sql = "DELETE FROM `st_supplier_good` WHERE (`gd_id`=:gd_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':gd_id', $this->getGd_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function editSupplier() {
		$sql = "UPDATE `st_supplier` SET  `sup_name`=:sup_name, `sup_address`=:sup_address, `sup_phone`=:sup_phone, `sup_email`=:sup_email WHERE (`sup_id` = :sup_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':sup_name', $this->getSup_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':sup_address', $this->getSup_address(), PDO::PARAM_STR);
			$createstmt->bindParam(':sup_phone', $this->getSup_phone(), PDO::PARAM_STR);
			$createstmt->bindParam(':sup_email', $this->getSup_email(), PDO::PARAM_STR);
			$createstmt->bindParam(':sup_id', $this->getSup_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate supplier name.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}
	
	public function editSupplierGoods() {
		$sql = "UPDATE `st_supplier_good` SET `gd_supplier`=:gd_supplier, `gd_name`=:gd_name WHERE (`gd_id` = :gd_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':gd_supplier', $this->getGd_supplier(), PDO::PARAM_INT);
			$createstmt->bindParam(':gd_name', $this->getGd_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':gd_id', $this->getGd_id(), PDO::PARAM_INT);			
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate supplier good name.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

}
