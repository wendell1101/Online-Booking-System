<?php
// extends Connection class
class UserController extends Connection
{
    private $data;
    private $errors = [];
    private static $fields = ['firstname', 'lastname', 'email', 'password1', 'password2'];
    private $loginFields = ['email', 'password'];

    public function __construct($data)
    {
        parent::__construct();
        $this->data = $data;
    }
    // Validate register
    public function validate()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field must not be empty");
                return;
            }

            $this->validateFirstname();
            $this->validateLastname();
            $this->validateEmail();
            $this->validatePassword1();
            $this->validatePassword2();
            $this->checkIfHasError();

            return $this->errors;
        }
    }

    // validate login
    public function validateLogin()
    {
        $this->validateEmail();
        $this->validateLoginPassword();
        $this->checkIfRegistered();
        return $this->errors;
    }

    //get data
    public function getData()
    {
        return $this->data;
    }
    // validate firstname
    private function validateFirstname()
    {
        //trim whitespace
        $val = trim($this->data['firstname']);
        // check if empty
        if (empty($val)) {
            $this->addError('firstname', 'Firstname must not be empty');
        } else {
            // match any lowercase/uppercase letter, any digits from 0-9, atleast 3-20 characters
            if (!preg_match('/^[a-zA-Z0-9]{3,20}$/', $val)) {
                $this->addError('firstname', 'Firstname must be 3-20 characters and alphanumeric');
            }
        }
    }
    //validate lastname
    private function validateLastname()
    {
        //trim whitespace
        $val = trim($this->data['lastname']);
        // check if empty
        if (empty($val)) {
            $this->addError('lastname', 'Lastname must not be empty');
        } else {
            // match any lowercase/uppercase letter, any digits from 0-9, atleast 3-20 characters
            if (!preg_match('/^[a-zA-Z0-9]{3,20}$/', $val)) {
                $this->addError('lastname', 'Lastname must be 3-20 characters and alphanumeric');
            }
        }
    }
    //validate email
    private function validateEmail()
    {
        //trim white space
        $val = trim($this->data['email']);
        // check if empty
        if (empty($val)) {
            $this->addError('email', 'Email must not be empty');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Email must be a valid email');
            }
        }
    }

    //Validate password1
    private function validatePassword1()
    {
        // trim white space
        $val = trim($this->data['password1']);
        // check if empty
        if (empty($val)) {
            $this->addError('password1', 'Password must not be empty');
        } else {
            $password1 = trim($this->data['password1']);
            $password2 = trim($this->data['password2']);
            if(!empty($password2)){
                if ($password1 !== $password2) {
                    $this->addError('password1', 'Passwords do not match. Please try again');
                }
            }
        }
    }

    //Validate password2
    private function validatePassword2()
    {
        // trim white space
        $val = trim($this->data['password2']);
        // check if empty
        if (empty($val)) {
            $this->addError('password2', 'Confirm-password must not be empty');
        } else {
            $password1 = trim($this->data['password1']);
            $password2 = trim($this->data['password2']);
            if ($password1 !== $password2) {
                $this->addError('password2', 'Passwords do not match. Please try again');
            }
        }
    }

    // validate login password
    private function validateLoginPassword(){
        $val = trim($this->data['password1']);
        if(empty($val)){
            $this->addError('password1', 'Password must not be empty');
        }
    }

    // add Error
    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
    //Check if no more errors
    private function checkIfHasError()
    {
        if (!array_filter($this->errors)) {
            $this->register();
        }
    }

    // register
    private function register()
    {
        // check if email already exists
        $sql = "SELECT * FROM users WHERE email=:email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $this->data['email']]);
        $user = $stmt->fetch();
        // if email already registered
        if ($stmt->rowCount()) {
            $this->errors['email'] = 'Email already exists. Please try a new one';
        } else {
            // register user using named params
            $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
            $stmt = $this->conn->prepare($sql);
            // hash the password before saving to the database
            $password = md5($this->data['password1']);

            // bind param and execute
            $run = $stmt->execute([
                'firstname' => $this->data['firstname'],
                'lastname' => $this->data['lastname'],
                'email' => $this->data['email'],
                'password' => $password,
            ]);



            // Get the newly registered user
            $lastId = $this->conn->lastInsertId();
            $sql = "SELECT * FROM users WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $run = $stmt->execute(['id' => $lastId]);
            $user = $stmt->fetch();


            if ($run) {
                // set session id
                $_SESSION['id'] = $user->id;
                $this->redirect('index.php');
            }
        }
    }


    // Check if user is registered for login
    private function checkIfRegistered()
    {
        if (!array_filter($this->errors)) {
            $this->login();
        }
    }

    //Login
    private function login()
    {
        // hash the password first
        $password = md5($this->data['password1']);
        $email = $this->data['email'];
        // check if valid credentials
        $sql = "SELECT * FROM users WHERE email=:email AND password=:password";
        $stmt = $this->conn->prepare($sql);
        // bind and execute
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch();
        if(!$stmt->rowCount() > 0){
            $this->addError('email', 'Invalid Credentials. An email or password is incorrect. Please try again');
            $this->addError('password1', 'Invalid Credentials. An email or password is incorrect. Please try again');

        }else{
            $_SESSION['id'] = $user->id;
            $this->redirect('index.php');
        }

    }

    // method to redirect pages
    public function redirect($address)
    {
        return header("Location: $address");
    }
}
