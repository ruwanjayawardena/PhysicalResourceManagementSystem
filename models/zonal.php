<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Zonal extends ConnectDB {

    const TBL_Zonal = 'st_zonal';

    private $flag = false;
    private $zol_id;
    private $zol_name;
    private $zol_province;

    public function getFlag() {
        return $this->flag;
    }

    public function getZol_id() {
        return $this->zol_id;
    }

    public function getZol_name() {
        return $this->zol_name;
    }

    public function getZol_province() {
        return $this->zol_province;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setZol_id($zol_id) {
        $this->zol_id = $zol_id;
    }

    public function setZol_name($zol_name) {
        $this->zol_name = $zol_name;
    }

    public function setZol_province($zol_province) {
        $this->zol_province = $zol_province;
    }

    public function getAllZonal() {
        $data = array();
        $sql = "SELECT
st_zonal.zol_id,
st_zonal.zol_name,
st_province.prov_name,
st_province.prov_id
FROM
st_zonal
INNER JOIN st_province ON st_zonal.zol_province = st_province.prov_id
WHERE
st_zonal.zol_province = :zol_province
ORDER BY
st_zonal.zol_id DESC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':zol_province', $this->getZol_province(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function cmbZonal() {
        $data = array();
        $sql = "SELECT
st_zonal.zol_id,
st_zonal.zol_name,
st_zonal.zol_province
FROM
st_zonal
WHERE
st_zonal.zol_province = :zol_province
ORDER BY
st_zonal.zol_name ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':zol_province', $this->getZol_province(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function getZonalByID() {
        $data = array();
        $sql = "SELECT
st_zonal.zol_id,
st_zonal.zol_name,
st_province.prov_name,
st_province.prov_id
FROM
st_zonal
INNER JOIN st_province ON st_zonal.zol_province = st_province.prov_id
WHERE
st_zonal.zol_id = :zol_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':zol_id', $this->getZol_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveZonal() {
        $sql = "INSERT INTO `st_zonal` (`zol_name`, `zol_province`) VALUES (:zol_name, :zol_province);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':zol_name', $this->getZol_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':zol_province', $this->getZol_province(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate zone.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

    public function deleteZonal() {
        $sql = "DELETE FROM `st_zonal` WHERE (`zol_id`=:zol_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':zol_id', $this->getZol_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editZonal() {
        $sql = "UPDATE `st_zonal` SET `zol_name`=:zol_name, `zol_province`=:zol_province WHERE (`zol_id`=:zol_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':zol_name', $this->getZol_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':zol_province', $this->getZol_province(), PDO::PARAM_INT);
            $createstmt->bindParam(':zol_id', $this->getZol_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate zone.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

}
