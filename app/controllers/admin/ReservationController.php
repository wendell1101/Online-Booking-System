<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

        $reservation = $this->getReservation($data['id']);
        $user = $this->getUser($reservation->user_id);

        if ($updated) {
            if ($reservation->status !== 'pending') {
                $date = $this->formatDate($reservation->date_time);
                $this->send_mail($user, $reservation, $date);
            } else {
                message('success', 'A reservation has been updated');
                redirect('reservations.php');
            }
        }
    }
    private function formatDate($date)
    {
        $d = new DateTime($date);
        return $d->format("F j \, Y \, g:ia \,\n l ");
    }
    // send email notification
    private function send_mail($user, $reservation, $date)
    {
        // Load Composer's autoloader
        require '../vendor/autoload.php';
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer();
        try {

            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = EMAIL;                     // SMTP username
            $mail->Password   = PASS;                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('coffeeroyale@gmail.com', 'Coffee Royale');
            $mail->addAddress($user->email);     // Add a recipient


            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Reservation Update';
            $mail->Body    = "
                <h3>Good day $user->firstname $user->lastname! </h3>
                <h4>Your reservation status is now $reservation->status. </h4>
                <p>Thank you for trusting us. </p><br><br>
                <p>Transaction Id: $reservation->transaction_id </p>
                <p>Reservation Date: $date </p>
            ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $sent = $mail->send();
            if ($sent) {
                message('success', 'A reservation has been updated');
                redirect('reservations.php');
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
