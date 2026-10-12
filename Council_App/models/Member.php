<?php
class Member {
    private $conn;
    private $table = "members";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Browse (Read All)
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Read Single
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Add (Create)
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (student_id, full_name, position, email) 
                  VALUES (:student_id, :full_name, :position, :email)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':student_id' => $data['student_id'],
            ':full_name'  => $data['full_name'],
            ':position'   => $data['position'],
            ':email'      => $data['email']
        ]);
    }

    // Update
    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET student_id = :student_id, full_name = :full_name, 
                      position = :position, email = :email 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id'         => $id,
            ':student_id' => $data['student_id'],
            ':full_name'  => $data['full_name'],
            ':position'   => $data['position'],
            ':email'      => $data['email']
        ]);
    }

    // Delete
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}