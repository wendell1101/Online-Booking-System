<?php
class AdminReservation extends Connection
{
    private $data;
    private $errors = [];
    private static $fields = ['date_time', 'no_of_people'];
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $sql = "SELECT * FROM reservations";
        $stmt = $this->conn->query($sql);
        $stmt->execute();
        return $reservations = $stmt->fetchAll();
    }

    public function getData()
    {
        return $this->data;
    }
    public function create($data)
    {
        $this->data = $data;
        $this->validate();
        $this->checkIfHasError();
    }
    //Error handling
    // Validate category name
    public function validate()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field must not be empty");
                return;
            }

            return $this->errors;
        }
    }



    //add error

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

    //Check if no more errors then insert data
    private function checkIfHasError()
    {
        if (!array_filter($this->errors)) {
            $name = $this->data['name'];
            $slug = slugify($name);
            // check if email already exists
            $sql = "SELECT * FROM users WHERE email=:email LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $this->data['email']]);
            $user = $stmt->fetch();
            // if email already registered
            if ($stmt->rowCount()) {
                $this->errors['email'] = 'Email already exists. Please try a new one';
            } else {
                $token = bin2hex(random_bytes(7));
                // register user using named params
                $sql = "INSERT INTO users (firstname, lastname, email, password, token, active) VALUES (:firstname, :lastname, :email, :password, :token, 1)";
                $stmt = $this->conn->prepare($sql);
                // hash the password before saving to the database
                $password = md5($this->data['password1']);

                // bind param and execute
                $run = $stmt->execute([
                    'firstname' => $this->data['firstname'],
                    'lastname' => $this->data['lastname'],
                    'email' => $this->data['email'],
                    'password' => $password,
                    'token' => $token,
                ]);
                $lastId = $this->conn->lastInsertId();
                if ($run) {
                    message('success', 'A new user has been created');
                    redirect('admin_users.php');
                }
            }
        }
    }


    // delete category
    public function delete($id)
    {
        $sql = "DELETE FROM reservations WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $deleted = $stmt->execute(['id' => $id]);
        if ($deleted) {
            message('success', 'A reservation has been deleted');
            redirect('reservations.php');
        } else {
            message('danger', 'Something went wrong. Failed to delete');
        }
    }
    // get single category
    public function getUser($id)
    {
        $sql = "SELECT * FROM users WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        return $user;
    }

    // get single reservation
    public function getReservation($id)
    {
        $sql = "SELECT * FROM reservations WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $reservation = $stmt->fetch();
        return $reservation;
    }

    public function update($data)
    {
        $sql = "UPDATE reservations set status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $updated = $stmt->execute([
            'status' => sanitize($data['status']),
            'id' => sanitize($data['id']),
        ]);
        if ($updated) {
            message('success', 'A reservation has been updated');
            redirect('reservations.php');
        }
    }
}
