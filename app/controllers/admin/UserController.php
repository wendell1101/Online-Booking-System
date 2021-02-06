<?php
class AdminUser extends Connection
{
    private $data;
    private $errors = [];
    private static $fields = ['firstname', 'lastname', 'email', 'password1', 'password2'];
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        $stmt->execute();
        return $users = $stmt->fetchAll();
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

            $this->validateFirstname();
            $this->validateLastname();
            $this->validateEmail();
            return $this->errors;
        }
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
        $sql = "DELETE FROM users WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $deleted = $stmt->execute(['id' => $id]);
        if ($deleted) {
            message('success', 'A user has been deleted');
            redirect('admin_users.php');
        } else {
            echo 'error in delete';
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

    //update category
    public function update($data)
    {
        $this->data = $data;
        $this->validate();
        $this->updateUser();
    }
    private function updateUser()
    {
        $password = md5($this->data['password1']);
        $id = $this->data['id'];
        if (!array_filter($this->errors)) {
            $sql = "UPDATE users set is_admin=:is_admin, is_product_manager=:is_product_manager WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $updated = $stmt->execute($this->updateRole());
            if ($updated) {
                message('success', 'A user has been updated');
                redirect('admin_users.php');
            }
        }
    }
    public function updateRole()
    {
        $id = $this->data['id'];
        if ($this->data['role'] === 'is_admin') {
            return ['is_admin' => 1, 'is_product_manager' => 0, 'id' => $id,];
        } else if ($this->data['role'] === 'is_product_manager') {
            return ['is_admin' => 0, 'is_product_manager' => 1, 'id' => $id,];
        } else {
            return ['is_admin' => 0, 'is_product_manager' => 0, 'id' => $id,];
        }
    }
}
