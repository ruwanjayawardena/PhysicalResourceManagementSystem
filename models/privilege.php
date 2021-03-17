<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Privilege extends ConnectDB {

    const TBL_Privilege = 'df_privilege';
    const TBL_AssignPrivilege = 'df_assign_privilege';

    private $flag = false;
    private $asn_id;
    private $asn_prvg_id;
    private $asn_usercategory;

    public function getFlag() {
        return $this->flag;
    }

    public function getAsn_id() {
        return $this->asn_id;
    }

    public function getAsn_prvg_id() {
        return $this->asn_prvg_id;
    }

    public function getAsn_usercategory() {
        return $this->asn_usercategory;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setAsn_id($asn_id) {
        $this->asn_id = $asn_id;
    }

    public function setAsn_prvg_id($asn_prvg_id) {
        $this->asn_prvg_id = $asn_prvg_id;
    }

    public function setAsn_usercategory($asn_usercategory) {
        $this->asn_usercategory = $asn_usercategory;
    }

    public function availablePrivileges() {
        $data = array();
        $sql = "SELECT
df_privilege.prvg_id,
df_privilege.prvg_name,
df_privilege.prvg_desc,
df_privilege.prvg_url,
df_privilege.prvg_icon_code,
df_privilege.prvg_menu_level,
df_privilege.prvg_main_prvg_id,
df_privilege.prvg_has_submenu,
df_privilege.prvg_create_date,
df_privilege.prvg_create_time
FROM
df_privilege
WHERE
df_privilege.prvg_id NOT IN (SELECT
df_assign_privilege.asn_prvg_id
FROM
df_assign_privilege
WHERE
df_assign_privilege.asn_usercategory = :asn_usercategory)
ORDER BY
df_privilege.prvg_id ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':asn_usercategory', $this->getAsn_usercategory(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }
    public function availablePrivilegesInstitute() {
        $data = array();
        $sql = "SELECT
df_privilege.prvg_id,
df_privilege.prvg_name,
df_privilege.prvg_desc,
df_privilege.prvg_url,
df_privilege.prvg_icon_code,
df_privilege.prvg_menu_level,
df_privilege.prvg_main_prvg_id,
df_privilege.prvg_has_submenu,
df_privilege.prvg_create_date,
df_privilege.prvg_create_time
FROM
df_user
INNER JOIN df_assign_privilege ON df_user.usr_usercategory = df_assign_privilege.asn_usercategory
INNER JOIN df_privilege ON df_assign_privilege.asn_prvg_id = df_privilege.prvg_id
WHERE
df_user.usr_id = ".$_SESSION['usr_id']." AND df_privilege.prvg_id NOT IN (SELECT
df_assign_privilege.asn_prvg_id
FROM
df_assign_privilege
WHERE
df_assign_privilege.asn_usercategory = :asn_usercategory)
ORDER BY
df_privilege.prvg_id ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':asn_usercategory', $this->getAsn_usercategory(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function assignedPrivileges() {
        $data = array();
        $sql = "SELECT
df_privilege.prvg_id,
df_privilege.prvg_name,
df_privilege.prvg_desc,
df_privilege.prvg_url,
df_privilege.prvg_icon_code,
df_privilege.prvg_menu_level,
df_privilege.prvg_main_prvg_id,
df_privilege.prvg_has_submenu,
df_privilege.prvg_create_date,
df_privilege.prvg_create_time
FROM
df_assign_privilege
INNER JOIN df_privilege ON df_assign_privilege.asn_prvg_id = df_privilege.prvg_id
WHERE
df_assign_privilege.asn_usercategory = :asn_usercategory";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':asn_usercategory', $this->getAsn_usercategory(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }
	
    public function assignedPrivilegesInstitute() {
        $data = array();
        $sql = "SELECT
df_privilege.prvg_id,
df_privilege.prvg_name,
df_privilege.prvg_desc,
df_privilege.prvg_url,
df_privilege.prvg_icon_code,
df_privilege.prvg_menu_level,
df_privilege.prvg_main_prvg_id,
df_privilege.prvg_has_submenu,
df_privilege.prvg_create_date,
df_privilege.prvg_create_time
FROM
df_assign_privilege
INNER JOIN df_privilege ON df_assign_privilege.asn_prvg_id = df_privilege.prvg_id
WHERE
df_assign_privilege.asn_usercategory = :asn_usercategory";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':asn_usercategory', $this->getAsn_usercategory(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

//    public function getPrivilegeByID() {
//        $data = array();
//        $sql = "SELECT
//df_usercategory.usrcat_id,
//df_usercategory.usrcat_name,
//df_usercategory.usrcat_institute
//FROM
//df_usercategory
//WHERE
//df_usercategory.usrcat_id = :usrcat_id";
//        try {
//            $readstmt = $this->con->prepare($sql);
//            $readstmt->bindParam(':usrcat_id', $this->getUsrcat_id(), PDO::PARAM_INT);
//            $readstmt->execute();
//            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
//                $data[] = $row;
//            }
//            echo json_encode($data);
//        } catch (Exception $exc) {
//            echo json_encode($data);
//        }
//    }

    public function assignPrivilege($assignselected) {
        $flag = FALSE;
        $explode_arr = explode(',', $assignselected);
        $filter_arr = array_filter($explode_arr);
        $sql = "INSERT INTO `df_assign_privilege` (`asn_prvg_id`, `asn_usercategory`) VALUES (:asn_prvg_id, :asn_usercategory);";
        try {
            $this->getCon()->beginTransaction();
            foreach ($filter_arr as $asn_prvg_id) {
                $createstmt = $this->con->prepare($sql);
                $createstmt->bindParam(':asn_prvg_id', $asn_prvg_id, PDO::PARAM_INT);
                $createstmt->bindParam(':asn_usercategory', $this->getAsn_usercategory(), PDO::PARAM_INT);
                $flag = $createstmt->execute();
            }
            if ($flag) {
                $this->getCon()->commit();
                echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
            } else {
                $this->getCon()->rollBack();
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
            }
        } catch (Exception $exc) {
            $this->getCon()->rollBack();
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }
    
    public function removePrivilege($removeselected) {
        $flag = FALSE;
        $explode_arr = explode(',', $removeselected);
        $filter_arr = array_filter($explode_arr);
        $sql = "DELETE FROM `df_assign_privilege` WHERE (`asn_prvg_id`=:asn_prvg_id) AND (`asn_usercategory`= :asn_usercategory);";
        try {
            $this->getCon()->beginTransaction();
            foreach ($filter_arr as $asn_prvg_id) {
                $createstmt = $this->con->prepare($sql);
                $createstmt->bindParam(':asn_prvg_id', $asn_prvg_id, PDO::PARAM_INT);
                $createstmt->bindParam(':asn_usercategory', $this->getAsn_usercategory(), PDO::PARAM_INT);
                $flag = $createstmt->execute();
            }
            if ($flag) {
                $this->getCon()->commit();
                echo json_encode(array("msgType" => 1, "msg" => "Successfully removed"));
            } else {
                $this->getCon()->rollBack();
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! removing failed"));
            }
        } catch (Exception $exc) {
            $this->getCon()->rollBack();
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

//    public function deletePrivilege() {
//        $sql = "DELETE FROM `df_usercategory` WHERE (`usrcat_id`=:usrcat_id);";
//        try {
//            $createstmt = $this->con->prepare($sql);
//            $createstmt->bindParam(':usrcat_id', $this->getUsrcat_id(), PDO::PARAM_INT);
//            if ($createstmt->execute()) {
//                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
//            } else {
//                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
//            }
//        } catch (Exception $exc) {
//            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
//        }
//    }
//    public function editPrivilege() {
//        $sql = "UPDATE `df_usercategory` SET `usrcat_name`=:usrcat_name, `usrcat_institute`=:usrcat_institute WHERE (`usrcat_id` = :usrcat_id);";
//        try {
//            $createstmt = $this->con->prepare($sql);
//            $createstmt->bindParam(':usrcat_name', $this->getUsrcat_name(), PDO::PARAM_STR);
//            $createstmt->bindParam(':usrcat_institute', $this->getUsrcat_institute(), PDO::PARAM_STR);
//            $createstmt->bindParam(':usrcat_id', $this->getUsrcat_id(), PDO::PARAM_INT);
//            if ($createstmt->execute()) {
//                echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
//            } else {
//                echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
//            }
//        } catch (Exception $exc) {
//            if ($exc->getCode() == 23000) {
//                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate attribute name.Please check and change it"));
//            } else {
//                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
//            }
//        }
//    }
}
