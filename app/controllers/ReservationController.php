<?php
class Reservation extends Connection
{
    private $data;
    private $errors = [];
    private static $fields = ['date_time', 'no_of_people', 'contact_number'];

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (isset($_SESSION['id'])) {
            $sql = "SELECT * from reservations WHERE user_id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $_SESSION['id']]);
            $reservations = $stmt->fetchAll();
            return $reservations;
        }
    }
    public function getData()
    {
        return $this->data;
    }
    public function reserve($data)
    {
        $this->data = $data;
        $this->validate();
        $this->checkIfHasError();
    }
    public function validate()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field must not be empty");
                return;
            }

            $this->validateDateTime();
            $this->validateNumOfPeople();
            $this->validateContactNumber();

            return $this->errors;
        }
    }

    private function validateDateTime()
    {
        // check if empty
        $val = $this->data['date_time'];
        if (empty($val)) {
            $this->addError('date_time', 'Date and time must not be empty');
        }
    }
    private function validateNumOfPeople()
    {
        // check if empty
        $val = $this->data['no_of_people'];
        if (empty($val)) {
            $this->addError('no_of_people', 'Number of people must be specified');
        }
    }
    private function validateContactNumber()
    {
        // check if empty
        $val = $this->data['contact_number'];
        if (empty($val)) {
            $this->addError('contact_number', 'Contact number must be specified');
        } else if (!preg_match('((^(\+)(\d){12}$)|(^\d{11}$))', $val)) {
            $this->addError('contact_number', 'Contact number must be a valid 11-digit contact number');
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
            if (isset($_SESSION['id'])) {
                $date_time = sanitize($this->data['date_time']);
                $no_of_people = sanitize($this->data['no_of_people']);
                $contact_number = sanitize($this->data['contact_number']);
                $transaction_id = bin2hex(random_bytes(7));
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                    $sql = "INSERT INTO reservations(transaction_id, date_time, no_of_people, contact_number, user_id)
                    VALUES (:transaction_id, :date_time, :no_of_people, :contact_number, :user_id)";
                    $stmt = $this->conn->prepare($sql);

                    $inserted = $stmt->execute([
                        'transaction_id' => $transaction_id,
                        'date_time' => $date_time,
                        'no_of_people' => $no_of_people,
                        'contact_number' => $contact_number,
                        'user_id' => $id,
                    ]);
                    $lastId = $this->conn->lastInsertId();
                    $user = $this->getUser($lastId);
                    $reservation = $this->getReservation($lastId);
                    if ($inserted) {
                        message('success', 'Your reservation is now being processed');
                        redirect("reservation_detail.php?id=$reservation->id&user_id=$reservation->user_id");
                    }
                }
            } else {
                message('danger', 'You need to login first to book a reservation');
                redirect('login.php');
            }
        }
    }
    public function getReservation($id)
    {
        $sql = "SELECT * FROM reservations WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $reservation = $stmt->fetch();
        return $reservation;
    }

    public function getUser($id)
    {
        $sql = "SELECT * FROM users WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        return $user;
    }
}
