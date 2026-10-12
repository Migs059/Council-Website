<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Member.php';

class MemberController {
    private $memberModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->memberModel = new Member($db);
    }

    public function index() {
        $members = $this->memberModel->getAll();
        require_once __DIR__ . '/../views/members/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'student_id' => $_POST['student_id'],
                'full_name'  => $_POST['full_name'],
                'position'   => $_POST['position'],
                'email'      => $_POST['email']
            ];
            if ($this->memberModel->create($data)) {
                header("Location: index.php?action=index");
                exit;
            }
        }
        require_once __DIR__ . '/../views/members/create.php';
    }

    public function edit($id) {
        $member = $this->memberModel->getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'student_id' => $_POST['student_id'],
                'full_name'  => $_POST['full_name'],
                'position'   => $_POST['position'],
                'email'      => $_POST['email']
            ];
            if ($this->memberModel->update($id, $data)) {
                header("Location: index.php?action=index");
                exit;
            }
        }
        require_once __DIR__ . '/../views/members/edit.php';
    }

    public function delete($id) {
        $this->memberModel->delete($id);
        header("Location: index.php?action=index");
        exit;
    }
}