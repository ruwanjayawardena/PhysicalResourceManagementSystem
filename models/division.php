<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Division extends ConnectDB {

    const TBL_Division = 'st_division';

    private $flag = false;
    private $div_id;
    private $div_name;
    private $div_zone;

    public function getFlag() {
        return $this->flag;
    }

    public function getDiv_id() {
        return $this->div_id;
    }

    public function getDiv_name() {
        return $this->div_name;
    }

    public function getDiv_zone() {
        return $this->div_zone;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setDiv_id($div_id) {
        $this->div_id = $div_id;
    }

    public function setDiv_name($div_name) {
        $this->div_name = $div_name;
    }

    public function setDiv_zone($div_zone) {
        $this->div_zone = $div_zone;
    }

    public function getAllDivision() {
        $data = array();
        $sql = "SELECT
st_division.div_id,
st_division.div_name,
st_division.div_zone,
st_zonal.zol_name,
st_province.prov_id,
st_province.prov_name
FROM
st_division
INNER JOIN st_zonal ON st_division.div_zone = st_zonal.zol_id
INNER JOIN st_province ON st_zonal.zol_province = st_province.prov_id
WHERE
st_division.div_zone = :div_zone
ORDER BY
st_division.div_id DESC
";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':div_zone', $this->getDiv_zone(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function cmbDivision() {
        $data = array();
        $sql = "SELECT
st_division.div_id,
st_division.div_name,
st_division.div_zone
FROM
st_division
WHERE
st_division.div_zone = :div_zone
ORDER BY
st_division.div_name ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':div_zone', $this->getDiv_zone(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function getDivisionByID() {
        $data = array();
        $sql = "SELECT
st_division.div_id,
st_division.div_name,
st_division.div_zone,
st_zonal.zol_name,
st_province.prov_id,
st_province.prov_name
FROM
st_division
INNER JOIN st_zonal ON st_division.div_zone = st_zonal.zol_id
INNER JOIN st_province ON st_zonal.zol_province = st_province.prov_id
WHERE
st_division.div_id  = :div_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':div_id', $this->getDiv_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveDivision() {
        $sql = "INSERT INTO `st_division` (`div_name`, `div_zone`) VALUES (:div_name, :div_zone);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':div_name', $this->getDiv_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':div_zone', $this->getDiv_zone(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate division.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

    public function deleteDivision() {
        $sql = "DELETE FROM `st_division` WHERE (`div_id`=:div_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':div_id', $this->getDiv_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editDivision() {
        $sql = "UPDATE `st_division` SET `div_name`=:div_name, `div_zone`=:div_zone WHERE (`div_id`=:div_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':div_name', $this->getDiv_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':div_zone', $this->getDiv_zone(), PDO::PARAM_INT);
            $createstmt->bindParam(':div_id', $this->getDiv_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate division.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

}
