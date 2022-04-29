<?php 
require_once "../classes/dbh.class.php";
class Admin extends Dbh {

    public function get($username) {
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getAll(){
        $sql = "SELECT * FROM admin";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function changePass($password, $username){
        $sql = "UPDATE admin SET password = ? WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$password, $username]);
    }

    public function otpUpdate($otp, $otp_time){
        $sql = "UPDATE admin SET otp = ?, otp_time = ? WHERE id = 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$otp, $otp_time]);
    }

    public function getOtp() {
        $sql = "SELECT otp, otp_time FROM admin";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function allComments($cus_name) {
        $sql = "SELECT * FROM `rating` INNER JOIN customers WHERE customer_id = customers.cus_id AND (customers.name LIKE '%$cus_name%' OR rating.feedback LIKE '%$cus_name%')";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetchAll()) {
           return $result;
        }
    }

    public function delBadComment($id) {
        $sql = "DELETE FROM rating WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    public function replyComment($reply, $id) {
        $sql = "UPDATE rating SET feedback_reply = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$reply, $id]);
    }

}