<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class UserCategory extends ConnectDB {

    const TBL_UserCategory = 'df_usercategory';

    private $flag = false;
    private $usrcat_id;
    private $usrcat_name;
    private $usrcat_institute;

    public function getFlag() {
        return $this->flag;
    }

    public function getUsrcat_id() {
        return $this->usrcat_id;
    }

    public function getUsrcat_name() {
        return $this->usrcat_name;
    }

    public function getUsrcat_institute() {
        return $this->usrcat_institute;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setUsrcat_id($usrcat_id) {
        $this->usrcat_id = $usrcat_id;
    }

    public function setUsrcat_name($usrcat_name) {
        $this->usrcat_name = $usrcat_name;
    }

    public function setUsrcat_institute($usrcat_institute) {
        $this->usrcat_institute = $usrcat_institute;
    }

    public function getAllUserCategory() {
        $data = array();
        $sql = "SELECT
df_usercategory.usrcat_id,
df_usercategory.usrcat_name,
df_usercategory.usrcat_institute
FROM
df_usercategory
WHERE
df_usercategory.usrcat_institute = :usrcat_institute
ORDER BY
df_usercategory.usrcat_id DESC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':usrcat_institute', $this->getUsrcat_institute(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }
    
    public function cmbUserCategory() {
        $data = array();
        $sql = "SELECT
df_usercategory.usrcat_id,
df_usercategory.usrcat_name,
df_usercategory.usrcat_institute
FROM
df_usercategory
WHERE
df_usercategory.usrcat_institute = :usrcat_institute
ORDER BY
df_usercategory.usrcat_name ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':usrcat_institute', $this->getUsrcat_institute(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function getUserCategoryByID() {
        $data = array();
        $sql = "SELECT
df_usercategory.usrcat_id,
df_usercategory.usrcat_name,
df_usercategory.usrcat_institute
FROM
df_usercategory
WHERE
df_usercategory.usrcat_id = :usrcat_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':usrcat_id', $this->getUsrcat_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveUserCategory() {
        $sql = "INSERT INTO `df_usercategory` (`usrcat_name`, `usrcat_institute`) VALUES (:usrcat_name, :usrcat_institute);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':usrcat_name', $this->getUsrcat_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':usrcat_institute', $this->getUsrcat_institute(), PDO::PARAM_STR);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate attribute name.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

    public function deleteUserCategory() {
        $sql = "DELETE FROM `df_usercategory` WHERE (`usrcat_id`=:usrcat_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':usrcat_id', $this->getUsrcat_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editUserCategory() {
        $sql = "UPDATE `df_usercategory` SET `usrcat_name`=:usrcat_name, `usrcat_institute`=:usrcat_institute WHERE (`usrcat_id` = :usrcat_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':usrcat_name', $this->getUsrcat_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':usrcat_institute', $this->getUsrcat_institute(), PDO::PARAM_STR);
            $createstmt->bindParam(':usrcat_id', $this->getUsrcat_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate attribute name.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

}
