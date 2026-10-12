<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Attendance.php';
require_once __DIR__ . '/../models/Event.php';

class AttendanceController {
    private $attendanceModel;
    private $eventModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->attendanceModel = new Attendance($db);
        $this->eventModel = new Event($db);
    }

    public function log($event_id) {
        $event = $this->eventModel->getById($event_id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attendance'])) {
            foreach ($_POST['attendance'] as $member_id => $status) {
                $this->attendanceModel->save($event_id, $member_id, $status);
            }
            header("Location: index.php?action=attendance_log&event_id=" . $event_id);
            exit;
        }

        $records = $this->attendanceModel->getByEvent($event_id);
        require_once __DIR__ . '/../views/attendance/log.php';
    }
}