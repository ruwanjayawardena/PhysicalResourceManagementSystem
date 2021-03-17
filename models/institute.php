<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Institute extends ConnectDB {

	const TBL_Institute_type = 'st_institute_type';

	private $flag = false;
	//institute type
	private $insttype_id;
	private $insttype_name;
	private $insttype_nature;
	//institute
	private $inst_id;
	private $inst_name;
	private $inst_address;
	private $inst_phone;
	private $inst_email;
	private $inst_province;
	private $inst_zonal;
	private $inst_division;
	private $inst_institutetype;
	private $inst_selection_key;
	private $inst_schgrade;
	private $inst_schclassification;
	private $inst_schmedium;
	private $inst_schownership;
	private $inst_schtype;
	private $inst_cus_id;

	public function getInst_cus_id() {
		return $this->inst_cus_id;
	}

	public function setInst_cus_id($inst_cus_id) {
		$this->inst_cus_id = $inst_cus_id;
	}

	public function getFlag() {
		return $this->flag;
	}

	//institute type
	public function getInsttype_nature() {
		return $this->insttype_nature;
	}

	public function setInsttype_nature($insttype_nature) {
		$this->insttype_nature = $insttype_nature;
	}

	public function getInsttype_id() {
		return $this->insttype_id;
	}

	public function getInsttype_name() {
		return $this->insttype_name;
	}

	public function setFlag($flag) {
		$this->flag = $flag;
	}

	public function setInsttype_id($insttype_id) {
		$this->insttype_id = $insttype_id;
	}

	public function setInsttype_name($insttype_name) {
		$this->insttype_name = $insttype_name;
	}

	//institute   
	public function getInst_schgrade() {
		return $this->inst_schgrade;
	}

	public function getInst_schclassification() {
		return $this->inst_schclassification;
	}

	public function getInst_schmedium() {
		return $this->inst_schmedium;
	}

	public function getInst_schownership() {
		return $this->inst_schownership;
	}

	public function getInst_schtype() {
		return $this->inst_schtype;
	}

	public function setInst_schgrade($inst_schgrade) {
		$this->inst_schgrade = $inst_schgrade;
	}

	public function setInst_schclassification($inst_schclassification) {
		$this->inst_schclassification = $inst_schclassification;
	}

	public function setInst_schmedium($inst_schmedium) {
		$this->inst_schmedium = $inst_schmedium;
	}

	public function setInst_schownership($inst_schownership) {
		$this->inst_schownership = $inst_schownership;
	}

	public function setInst_schtype($inst_schtype) {
		$this->inst_schtype = $inst_schtype;
	}

	public function getInst_id() {
		return $this->inst_id;
	}

	public function getInst_name() {
		return $this->inst_name;
	}

	public function getInst_address() {
		return $this->inst_address;
	}

	public function getInst_phone() {
		return $this->inst_phone;
	}

	public function getInst_email() {
		return $this->inst_email;
	}

	public function getInst_province() {
		return $this->inst_province;
	}

	public function getInst_zonal() {
		return $this->inst_zonal;
	}

	public function getInst_division() {
		return $this->inst_division;
	}

	public function getInst_institutetype() {
		return $this->inst_institutetype;
	}

	public function getInst_selection_key() {
		return $this->inst_selection_key;
	}

	public function setInst_id($inst_id) {
		$this->inst_id = $inst_id;
	}

	public function setInst_name($inst_name) {
		$this->inst_name = $inst_name;
	}

	public function setInst_address($inst_address) {
		$this->inst_address = $inst_address;
	}

	public function setInst_phone($inst_phone) {
		$this->inst_phone = $inst_phone;
	}

	public function setInst_email($inst_email) {
		$this->inst_email = $inst_email;
	}

	public function setInst_province($inst_province) {
		$this->inst_province = $inst_province;
	}

	public function setInst_zonal($inst_zonal) {
		$this->inst_zonal = $inst_zonal;
	}

	public function setInst_division($inst_division) {
		$this->inst_division = $inst_division;
	}

	public function setInst_institutetype($inst_institutetype) {
		$this->inst_institutetype = $inst_institutetype;
	}

	public function setInst_selection_key($inst_selection_key) {
		$this->inst_selection_key = $inst_selection_key;
	}

	public function getAllInstituteType() {
		$data = array();
		$sql = "SELECT
st_institute_type.insttype_id,
st_institute_type.insttype_name,
st_institute_type.insttype_nature
FROM
st_institute_type
ORDER BY
st_institute_type.insttype_id DESC";
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

	public function getAllInstitute() {
		$data = array();
		$sql = "SELECT
st_institute.inst_id,
st_institute.inst_name,
st_institute.inst_cus_id,
st_institute.inst_address,
st_institute.inst_phone,
st_institute.inst_email,
st_institute.inst_province,
st_institute.inst_zonal,
st_institute.inst_division,
st_institute.inst_institutetype,
st_institute.inst_selection_key,
st_division.div_name,
st_zonal.zol_name,
st_zonal.zol_id,
st_division.div_id,
st_province.prov_id,
st_province.prov_name,
st_institute_type.insttype_name,
st_institute_type.insttype_id
FROM
st_institute
INNER JOIN st_division ON st_institute.inst_division = st_division.div_id
INNER JOIN st_zonal ON st_institute.inst_zonal = st_zonal.zol_id AND st_division.div_zone = st_zonal.zol_id
INNER JOIN st_province ON st_institute.inst_province = st_province.prov_id AND st_zonal.zol_province = st_province.prov_id
INNER JOIN st_institute_type ON st_institute.inst_institutetype = st_institute_type.insttype_id
WHERE
st_institute.inst_division = :inst_division";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':inst_division', $this->getInst_division(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function cmbInstitute() {
		$data = array();
		$sql = "SELECT
st_institute.inst_id,
st_institute.inst_name
FROM
st_institute
WHERE
st_institute.inst_division = :inst_division AND
st_institute.inst_institutetype = :inst_institutetype";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':inst_division', $this->getInst_division(), PDO::PARAM_INT);
			$readstmt->bindParam(':inst_institutetype', $this->getInst_institutetype(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function cmbInstituteExceptLoggedOne() {
		$data = array();
		$sql = "SELECT
st_institute.inst_id,
st_institute.inst_name
FROM
st_institute
WHERE
st_institute.inst_division = :inst_division AND
st_institute.inst_institutetype = :inst_institutetype AND
st_institute.inst_id <> :inst_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':inst_division', $this->getInst_division(), PDO::PARAM_INT);
			$readstmt->bindParam(':inst_institutetype', $this->getInst_institutetype(), PDO::PARAM_INT);
			$readstmt->bindParam(':inst_id', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function cmbInstituteType() {
		$data = array();
		$sql = "SELECT
st_institute_type.insttype_id,
st_institute_type.insttype_name,
st_institute_type.insttype_nature
FROM
st_institute_type
ORDER BY
st_institute_type.insttype_name ASC";
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

	//school options
	public function cmbSchoolType() {
		$data = array();
		$sql = "SELECT
st_school_type.schtype_id,
st_school_type.schtype_name
FROM
st_school_type
ORDER BY
st_school_type.schtype_id ASC";
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

	public function cmbSchoolOwnership() {
		$data = array();
		$sql = "SELECT
st_school_ownership.schowsh_id,
st_school_ownership.schowsh_name
FROM
st_school_ownership
ORDER BY
st_school_ownership.schowsh_id ASC";
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

	public function cmbSchoolMedium() {
		$data = array();
		$sql = "SELECT
st_school_medium.schmd_id,
st_school_medium.schmd_name
FROM
st_school_medium
ORDER BY
st_school_medium.schmd_id ASC";
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

	public function cmbSchoolClassification() {
		$data = array();
		$sql = "SELECT
st_school_classification.schcl_id,
st_school_classification.schcl_name
FROM
st_school_classification
ORDER BY
st_school_classification.schcl_id ASC";
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

	public function cmbSchoolGrade() {
		$data = array();
		$sql = "SELECT
st_school_grade.schgrd_id,
st_school_grade.schgrd_name
FROM
st_school_grade
ORDER BY
st_school_grade.schgrd_id ASC";
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

	//end of school options


	public function getInstituteTypeByID() {
		$data = array();
		$sql = "SELECT
st_institute_type.insttype_id,
st_institute_type.insttype_name,
st_institute_type.insttype_nature
FROM
st_institute_type
WHERE
st_institute_type.insttype_id = :insttype_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':insttype_id', $this->getInsttype_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getInstituteByID() {
		$data = array();
		$sql = "SELECT
st_institute.inst_id,
st_institute.inst_name,
st_institute.inst_cus_id,
st_institute.inst_address,
st_institute.inst_phone,
st_institute.inst_email,
st_institute.inst_province,
st_institute.inst_zonal,
st_institute.inst_division,
st_institute.inst_institutetype,
st_institute.inst_selection_key,
st_division.div_name,
st_zonal.zol_name,
st_zonal.zol_id,
st_division.div_id,
st_province.prov_id,
st_province.prov_name,
st_institute_type.insttype_name,
st_institute_type.insttype_id,
st_institute_type.insttype_nature,
st_institute.inst_schtype,
st_institute.inst_schownership,
st_institute.inst_schmedium,
st_institute.inst_schclassification,
st_institute.inst_schgrade
FROM
st_institute
INNER JOIN st_division ON st_institute.inst_division = st_division.div_id
INNER JOIN st_zonal ON st_institute.inst_zonal = st_zonal.zol_id AND st_division.div_zone = st_zonal.zol_id
INNER JOIN st_province ON st_institute.inst_province = st_province.prov_id AND st_zonal.zol_province = st_province.prov_id
INNER JOIN st_institute_type ON st_institute.inst_institutetype = st_institute_type.insttype_id
WHERE
st_institute.inst_id = :inst_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':inst_id', $this->getInst_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function saveInstituteType() {
		$sql = "INSERT INTO `st_institute_type` (`insttype_name`, `insttype_nature`) VALUES (:insttype_name, :insttype_nature);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':insttype_name', $this->getInsttype_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':insttype_nature', $this->getInsttype_nature(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate institute type.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getCode()));
			}
		}
	}

	public function saveInstitute() {
		$null = null;
		$sql = "INSERT INTO `st_institute` (`inst_name`, `inst_address`, `inst_phone`, `inst_email`, `inst_province`, `inst_zonal`, `inst_division`, `inst_institutetype`, `inst_selection_key`, `inst_schtype`, `inst_schownership`, `inst_schmedium`, `inst_schclassification`, `inst_schgrade`,`inst_cus_id`) VALUES (:inst_name, :inst_address, :inst_phone, :inst_email, :inst_province, :inst_zonal, :inst_division, :inst_institutetype, :inst_selection_key, :inst_schtype, :inst_schownership, :inst_schmedium, :inst_schclassification, :inst_schgrade,:inst_cus_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':inst_name', $this->getInst_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':inst_address', $this->getInst_address(), PDO::PARAM_STR);
			$createstmt->bindParam(':inst_phone', $this->getInst_phone(), PDO::PARAM_STR);
			$createstmt->bindParam(':inst_email', $this->getInst_email(), PDO::PARAM_STR);
			$createstmt->bindParam(':inst_province', $this->getInst_province(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_zonal', $this->getInst_zonal(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_division', $this->getInst_division(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_institutetype', $this->getInst_institutetype(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_selection_key', $this->getInst_selection_key(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schtype', $this->getInst_schtype(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schownership', $this->getInst_schownership(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schmedium', $this->getInst_schmedium(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schclassification', $this->getInst_schclassification(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schgrade', $this->getInst_schgrade(), PDO::PARAM_INT);
			if ($this->getInst_cus_id() == "") {
				$createstmt->bindParam(':inst_cus_id', $null, PDO::PARAM_NULL);
			} else {
				$createstmt->bindParam(':inst_cus_id', $this->getInst_cus_id(), PDO::PARAM_STR);
			}
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function deleteInstituteType() {
		$sql = "DELETE FROM `st_institute_type` WHERE (`insttype_id`=:insttype_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':insttype_id', $this->getInsttype_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function deleteInstitute() {
		$sql = "DELETE FROM `st_institute` WHERE (`inst_id`=:inst_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':inst_id', $this->getInst_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function editInstituteType() {
		$sql = "UPDATE `st_institute_type` SET `insttype_name`=:insttype_name, `insttype_nature`=:insttype_nature WHERE (`insttype_id` = :insttype_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':insttype_id', $this->getInsttype_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':insttype_name', $this->getInsttype_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':insttype_nature', $this->getInsttype_nature(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate institute type.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function editInstitute() {
		$null = null;
		$sql = "UPDATE `st_institute` SET `inst_name`=:inst_name, `inst_address`=:inst_address, `inst_phone`=:inst_phone, `inst_email`=:inst_email, `inst_province`=:inst_province, `inst_zonal`=:inst_zonal, `inst_division`=:inst_division, `inst_institutetype`=:inst_institutetype, `inst_selection_key`=:inst_selection_key, `inst_schtype`=:inst_schtype, `inst_schownership`=:inst_schownership, `inst_schmedium`=:inst_schmedium, `inst_schclassification`=:inst_schclassification, `inst_schgrade`=:inst_schgrade, `inst_cus_id` = :inst_cus_id WHERE (`inst_id`=:inst_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':inst_name', $this->getInst_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':inst_address', $this->getInst_address(), PDO::PARAM_STR);
			$createstmt->bindParam(':inst_phone', $this->getInst_phone(), PDO::PARAM_STR);
			$createstmt->bindParam(':inst_email', $this->getInst_email(), PDO::PARAM_STR);
			$createstmt->bindParam(':inst_province', $this->getInst_province(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_zonal', $this->getInst_zonal(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_division', $this->getInst_division(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_institutetype', $this->getInst_institutetype(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_selection_key', $this->getInst_selection_key(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schtype', $this->getInst_schtype(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schownership', $this->getInst_schownership(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schmedium', $this->getInst_schmedium(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schclassification', $this->getInst_schclassification(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_schgrade', $this->getInst_schgrade(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_id', $this->getInst_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':inst_cus_id', $this->getInst_cus_id(), PDO::PARAM_STR);
			if ($this->getInst_cus_id() == "") {
				$createstmt->bindParam(':inst_cus_id', $null, PDO::PARAM_NULL);
			} else {
				$createstmt->bindParam(':inst_cus_id', $this->getInst_cus_id(), PDO::PARAM_STR);
			}
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

}
