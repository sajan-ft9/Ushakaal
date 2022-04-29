<?php
require_once "../classes/dbh.class.php";
class Blog extends Dbh {

    public function addBlog($cust_id, $name, $description, $photo) {
        $sql = "INSERT INTO `blog`(`cust_id`, `title`, `description`, `photo`) VALUES (?, ?, ?, ?)";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$cust_id, $name, $description, $photo]);
    }

    public function getall(){
        $sql = "SELECT * FROM `blog` INNER JOIN customers WHERE blog.cust_id=customers.cus_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function getid($blog_creator){
        $sql = "SELECT * FROM `blog` WHERE cust_id= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$blog_creator]);

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function get_blogid($blog_id){
        $sql = "DELETE FROM `blog` WHERE blog_id= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$blog_id]);
        // while($result = $stmt->fetchAll()) {
        //     return $result;
        // }
    }

    public function selected($blog_id1){
        $sql = "SELECT * FROM `blog` WHERE blog_id= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$blog_id1]);

        while($result = $stmt->fetch()) {
            return $result;
        }
    }


    public function edit_blogid($name, $description, $newFileName,$id){
        $sql = "UPDATE `blog` SET `title`=?,`description`=?,`photo`=? WHERE blog_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $description, $newFileName,$id]);

        // while($result = $stmt->fetchAll()) {
        //     return $result;
        // }
    }


}