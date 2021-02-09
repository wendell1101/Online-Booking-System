<?php
class Reservation extends Connection
{
    private $data;
    private $errors = [];
    private static $fields = ['date_time', 'no_of_people'];

    public function __construct()
    {
        parent::__construct();
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
    //add error

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

    //Check if no more errors then insert data
    private function checkIfHasError()
    {

        if (!array_filter($this->errors)) {
            $date_time = sanitize($this->data['date_time']);
            $no_of_people = sanitize($this->data['no_of_people']);
            $transaction_id = bin2hex(random_bytes(7));
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $sql = "INSERT INTO reservations(transaction_id, date_time, no_of_people, user_id)
                VALUES (:transaction_id, :date_time, :no_of_people, :user_id)";
                $stmt = $this->conn->prepare($sql);

                $inserted = $stmt->execute([
                    'transaction_id' => $transaction_id,
                    'date_time' => $date_time,
                    'no_of_people' => $no_of_people,
                    'user_id' => $id,
                ]);
                $lastId = $this->conn->lastInsertId();
                $reservation = $this->getReservation($lastId);
                if ($inserted) {
                    $_SESSION['reservation'] = $reservation;
                    message('success', 'Your reservation is now being processed');
                    redirect('reservation_detail.php');
                }
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
