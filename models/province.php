<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Province extends ConnectDB {

    const TBL_Province = 'st_province';

    private $flag = false;
    private $prov_id;
    private $prov_name;

    public function getFlag() {
        return $this->flag;
    }

    public function getProv_id() {
        return $this->prov_id;
    }

    public function getProv_name() {
        return $this->prov_name;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setProv_id($prov_id) {
        $this->prov_id = $prov_id;
    }

    public function setProv_name($prov_name) {
        $this->prov_name = $prov_name;
    }

    public function getAllProvince() {
        $data = array();
        $sql = "SELECT
st_province.prov_id,
st_province.prov_name
FROM
st_province
ORDER BY
st_province.prov_id DESC";
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

    public function cmbProvince() {
        $data = array();
        $sql = "SELECT
st_province.prov_id,
st_province.prov_name
FROM
st_province
ORDER BY
st_province.prov_name ASC";
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

    public function getProvinceByID() {
        $data = array();
        $sql = "SELECT
st_province.prov_id,
st_province.prov_name
FROM
st_province
WHERE
st_province.prov_id = :prov_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':prov_id', $this->getProv_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveProvince() {
        $sql = "INSERT INTO `st_province` (`prov_name`) VALUES (:prov_name);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':prov_name', $this->getProv_name(), PDO::PARAM_STR);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate province name.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

    public function deleteProvince() {
        $sql = "DELETE FROM `st_province` WHERE (`prov_id`=:prov_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':prov_id', $this->getProv_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editProvince() {
        $sql = "UPDATE `st_province` SET `prov_name`=:prov_name WHERE (`prov_id` = :prov_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':prov_id', $this->getProv_id(), PDO::PARAM_INT);
            $createstmt->bindParam(':prov_name', $this->getProv_name(), PDO::PARAM_STR);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate province name.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

}
