<?php
require_once 'C:\xampp\htdocs\ScreenActorAward\app\models\UserModel.php';
require_once 'C:\xampp\htdocs\ScreenActorAward\public\Database\config.php';

class UserController
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new UserModel();
    }


    public function loginDetail()
    {
        require_once '../app/views/Login.php';
    }

    public function adminPageDetail()
    {
        require_once '../app/views/AdminPage.php';
    }

    public function statistics()
    {

        require_once '../app/views/Statistics.php';
    }

    public function getUsersPaginated($page, $pageSize)
    {
        $userModel = new UserModel();
        return $userModel->getUsersPaginated($page, $pageSize);
    }

    public function getScreenActorGuildAwardsPaginated($page, $pageSize)
    {
        $userModel = new UserModel();
        return $userModel->getScreenActorGuildAwardsPaginated($page, $pageSize);
    }

    public function getScreenActorGuildAwardsPaginatedByYear($year, $page, $pageSize)
    {
        $userModel = new UserModel();
        return $userModel->getScreenActorGuildAwardsPaginatedByYear($year, $page, $pageSize);
    }

    public function getTotalUsers()
    {
        $userModel = new UserModel();
        return $userModel->getTotalUsers();
    }

    public function getTotalAwards()
    {
        $userModel = new UserModel();
        return $userModel->getTotalAwards();
    }

    public function getTotalAwardsByYear($year)
    {
        $userModel = new UserModel();
        return $userModel->getTotalAwardsByYear($year);
    }


    public function addIdColumnToScreenActorGuildAwards()
    {
        $userModel = new UserModel();
        return $userModel->addIdColumnToScreenActorGuildAwards();
    }

    public function addUser($firstname, $lastname, $username, $email, $password)
    {
        $userModel = new UserModel();
        return $userModel->addUser($firstname, $lastname, $username, $email, $password);
    }

    public function addAward($year, $category, $full_name, $won)
    {
        $userModel = new UserModel();
        return $userModel->addAward($year, $category, $full_name, $won);
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->firstname = $_POST['firstname'];
            $this->user->lastname = $_POST['lastname'];
            $this->user->email = $_POST['email'];
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            if ($this->user->register()) {
                echo 'User is here!';
                header('Location: http://localhost/ScreenActorAward/public/login');
                exit();
            } else {
                echo 'Username exists, please choose another!';
            }
        } else {
            include_once 'C:\xampp\htdocs\ScreenActorAward\app\views\Register.php';
        }

    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            if ($this->user->login()) {
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $this->user->username;
                $_SESSION['id'] = $this->user->id;
                header('Location: http://localhost/ScreenActorAward/public/admin');
            } else {
                header('Location: http://localhost/ScreenActorAward/public/login');
            }
        } else {
            include_once 'C:\xampp\htdocs\ScreenActorAward\app\views\Login.php';
        }
    }

    public function logout()
    {

        $_SESSION['loggedin'] = FALSE;
        header('Location: http://localhost/ScreenActorAward/public/home');
        exit;
    }

    public function uploadCSV()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
            $csvFile = $_FILES['csv_file']['tmp_name'];
            $this->processCSV($csvFile);
        } else {
            echo 'Ups a fost o problema la upload!';
        }
    }

    private function processCSV($filePath)
    {
        $file = fopen($filePath, 'r');

        if ($file !== FALSE) {
            $header = fgetcsv($file);

            $userModel = new UserModel();
            while (($row = fgetcsv($file)) !== FALSE) {
                $data = array_combine($header, $row);
                $userModel->insertOrUpdate($data);
            }
            fclose($file);
        } else {
            echo 'Ups a fost o problema la upload!';
        }
    }

    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $userId = $_POST['id'];
            $userModel = new UserModel();
            $userModel->deleteUserById($userId);
            header('Location: http://localhost/ScreenActorAward/public/admin');
        }
    }

    public function deleteAward()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $awardId = $_POST['id'];
            $userModel = new UserModel();
            $userModel->deleteAwardById($awardId);
            header('Location: http://localhost/ScreenActorAward/public/admin');
        }
    }

    public function editUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $userId = $_POST['id'];
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'age' => $_POST['age']
            ];
            $userModel = new UserModel();
            $userModel->updateUserById($userId, $data);
            header('Location: http://localhost/ScreenActorAward/public/admin');
        }
    }
}
?>