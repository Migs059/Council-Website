<?php
require_once 'controllers/MemberController.php';
require_once 'controllers/EventController.php';
require_once 'controllers/AttendanceController.php';

$memberCtrl = new MemberController();
$eventCtrl = new EventController();
$attendanceCtrl = new AttendanceController();

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;
$event_id = $_GET['event_id'] ?? null;

switch ($action) {
    // Member Routes
    case 'create':
        $memberCtrl->create();
        break;
    case 'edit':
        if ($id) $memberCtrl->edit($id);
        break;
    case 'delete':
        if ($id) $memberCtrl->delete($id);
        break;

    // Event Routes
    case 'events':
        $eventCtrl->index();
        break;
    case 'event_create':
        $eventCtrl->create();
        break;
    case 'event_edit':
        if ($id) $eventCtrl->edit($id);
        break;
    case 'event_delete':
        if ($id) $eventCtrl->delete($id);
        break;

    // Attendance Route
    case 'attendance_log':
        if ($event_id) $attendanceCtrl->log($event_id);
        break;

    // Default: Member List
    case 'index':
    default:
        $memberCtrl->index();
        break;
}