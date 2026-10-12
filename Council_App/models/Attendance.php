<?php
class Attendance {
    private $conn;
    private $table = "attendance";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByEvent($event_id) {
        $sql = "SELECT m.id as member_id, m.full_name, m.position, a.status 
                FROM members m 
                LEFT JOIN " . $this->table . " a ON m.id = a.member_id AND a.event_id = :event_id
                ORDER BY m.full_name ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':event_id' => $event_id]);
        return $stmt->fetchAll();
    }

    public function save($event_id, $member_id, $status) {
        $sql = "INSERT INTO " . $this->table . " (event_id, member_id, status) 
                VALUES (:event_id, :member_id, :status)
                ON DUPLICATE KEY UPDATE status = :status";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':event_id'  => $event_id,
            ':member_id' => $member_id,
            ':status'    => $status
        ]);
    }
}