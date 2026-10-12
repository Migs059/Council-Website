<?php
class Event {
    private $conn;
    private $table = "events";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " ORDER BY event_date DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO " . $this->table . " (title, description, event_date, location) 
                VALUES (:title, :description, :event_date, :location)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':title'       => $data['title'],
            ':description' => $data['description'],
            ':event_date'  => $data['event_date'],
            ':location'    => $data['location']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE " . $this->table . " 
                SET title = :title, description = :description, 
                    event_date = :event_date, location = :location 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id'          => $id,
            ':title'       => $data['title'],
            ':description' => $data['description'],
            ':event_date'  => $data['event_date'],
            ':location'    => $data['location']
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}