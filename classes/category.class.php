<?php

require_once "../classes/dbh.class.php";
class Category extends Dbh {

    public function getAll() {
        $sql = "SELECT * FROM `categories`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function selected($id) {
        $sql = "SELECT * FROM `categories` WHERE ct_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();
        return $result;
    }
    
    public function selectedCategory($id) {
        $sql = "SELECT * FROM `categories` INNER JOIN products WHERE ct_id = ? and products.cat_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, $id]);

        while($result = $stmt->fetchAll()){
            return $result;
        }
    }

    public function addCategory($name, $desc) {
        $sql = "INSERT INTO categories (ct_name, ct_desc) VALUES (?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $desc]);
    }

    public function delete($id) {
        $sql = "DELETE FROM categories WHERE ct_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    public function update($name, $desc, $id) {
        $sql = "UPDATE categories set ct_name = ?, ct_desc = ? WHERE ct_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $desc, $id]);
    }

}