<?php
class Product extends Connection
{
    private $data;
    private $errors = [];
    private $uploadOk = 0;
    private $target_file;
    private static $fields = ['name', 'image', 'price', 'description', 'category_id'];
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->query($sql);
        $stmt->execute();
        return $products = $stmt->fetchAll();
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
            $this->validateProductImage();
            $this->validateProductName();
            $this->validateProductPrice();
            $this->validateProductDescription();
            $this->validateCategory();
            return $this->errors;
        }
    }

    // get data
    public function getData()
    {
        return $this->data;
    }
    // validate product name
    private function validateProductName()
    {
        // check if empty
        $val = $this->data['name'];
        if (empty($val)) {
            $this->addError('name', 'Product name must not be empty');
        }
    }
    // validate product price
    private function validateProductPrice()
    {
        // check if empty
        $val = $this->data['price'];
        if (empty($val)) {
            $this->addError('price', 'Product price must not be empty');
        } else {
            if (!preg_match('(\d+\.\d{1,2})', $this->data['price'])) {
                $this->addError('price', 'Product price must be a number with 2 decimal places');
            }
        }
    }
    // validate product description
    private function validateProductDescription()
    {
        // check if empty
        $val = $this->data['description'];
        if (empty($val)) {
            $this->addError('description', 'Product description must not be empty');
        }
    }
    // validate product image
    private function validateProductImage()
    {
        if (!empty($_FILES['image']['name'])) {
            $imageName = time() . "_" . $_FILES['image']['name'];
            $tmpDestination = $_FILES['image']['tmp_name'];
            $imageDestination = BASE . "/assets/img/product_images/" . $imageName;
            $result = move_uploaded_file($tmpDestination, $imageDestination);

            if (!$result) {
                $this->addError('image', 'Image upload Failed');
            }
        } else {
            $this->addError('image', 'Product image should not be empty');
        }
    }
    // validate category
    private function validateCategory()
    {
        if ($this->data['category_id'] === 'null') {
            $this->addError('category_id', 'You must choose a product category');
        }
    }
    //add error

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

    // get all categories
    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }
    //Check if no more errors then insert data
    private function checkIfHasError()
    {
        if (!array_filter($this->errors)) {
            $name = $this->data['name'];
            $slug = slugify($name);
            $image = $imageName = time() . "_" . $_FILES['image']['name'];
            $price = $this->data['price'];
            $description = $this->data['description'];
            $category_id = $this->data['category_id'];

            // save to database
            $sql = "INSERT INTO products (name, slug, image, price, description, category_id)
            VALUES (:name, :slug, :image, :price, :description, :category_id)";
            $stmt = $this->conn->prepare($sql);
            $run = $stmt->execute([
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
                'price' => $price,
                'description' => $description,
                'category_id' => $category_id,
            ]);
            if ($run) {
                message('success', 'A new product has been created');
                redirect('products.php');
            }
        }
    }

    // delete category
    public function delete($id)
    {
        $product = $this->getProduct($id);
        $sql = "DELETE FROM products WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $deleted = $stmt->execute(['id' => $id]);
        // also delete the image in the product images folder
        unlink(BASE . '/assets/img/product_images/' . $product->image);
        if ($deleted) {
            message('success', 'A product has been deleted');
            redirect('products.php');
        } else {
            message('danger', 'Failed to delete product');
        }
    }
    // get single category
    public function getProduct($id)
    {
        $sql = "SELECT * FROM products WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();
        return $product;
    }

    //update category
    public function update($data)
    {
        $this->data = $data;
        $this->validate();
        $this->updateProduct();
    }
    private function updateProduct()
    {
        $name = $this->data['name'];
        $slug = slugify($name);
        $image = time() . "_" . $_FILES['image']['name'];
        $price = $this->data['price'];
        $description = $this->data['description'];
        $category_id = $this->data['category_id'];
        $id = $this->data['id'];

        $product = $this->getProduct($id);
        unlink(BASE . '/assets/img/product_images/' . $product->image);

        if (!array_filter($this->errors)) {
            $sql = "UPDATE products set name=:name, slug=:slug, image=:image, price=:price,
            description=:description, category_id=:category_id WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $updated = $stmt->execute([
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
                'price' => $price,
                'description' => $description,
                'category_id' => $category_id,
                'id' => $id,
            ]);
            if ($updated) {
                message('success', 'A product has been updated');
                redirect('products.php');
            }
        }
    }

    // set price format
    public function showPrice($price)
    {
        return 'PHP ' . number_format((float)$price, 2, '.', '');
    }
}
