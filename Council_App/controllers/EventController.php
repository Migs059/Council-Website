<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Event.php';

class EventController {
    private $eventModel;

    public function __construct() {
        $database = new Database();
        $this->eventModel = new Event($database->getConnection());
    }

    public function index() {
        $events = $this->eventModel->getAll();
        require_once __DIR__ . '/../views/events/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'       => $_POST['title'],
                'description' => $_POST['description'],
                'event_date'  => $_POST['event_date'],
                'location'    => $_POST['location']
            ];
            if ($this->eventModel->create($data)) {
                header("Location: index.php?action=events");
                exit;
            }
        }
        require_once __DIR__ . '/../views/events/create.php';
    }

    public function edit($id) {
        $event = $this->eventModel->getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'       => $_POST['title'],
                'description' => $_POST['description'],
                'event_date'  => $_POST['event_date'],
                'location'    => $_POST['location']
            ];
            if ($this->eventModel->update($id, $data)) {
                header("Location: index.php?action=events");
                exit;
            }
        }
        require_once __DIR__ . '/../views/events/edit.php';
    }

    public function delete($id) {
        $this->eventModel->delete($id);
        header("Location: index.php?action=events");
        exit;
    }
}