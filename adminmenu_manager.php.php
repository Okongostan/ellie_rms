<?php
require_once '../includes/auth.php';
require_once '../includes/db_connect.php';

// Add new food item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_item'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    
    // Handle image upload
    $image_path = '';
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../public/images/";
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = "images/" . $new_filename;
        }
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO menu_items (name, price, category, description, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $price, $category, $description, $image_path]);
        $success = "Menu item added successfully!";
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Get all menu items
$menu_items = $pdo->query("SELECT * FROM menu_items ORDER BY category, name")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Menu Items Management</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Food Name" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <select name="category" required>
        <option value="Appetizers">Appetizers</option>
        <option value="Main Courses">Main Courses</option>
        <option value="Desserts">Desserts</option>
        <option value="Beverages">Beverages</option>
    </select>
    <textarea name="description" placeholder="Description"></textarea>
    <input type="file" name="image" accept="image/*">
    <button type="submit" name="add_item">Add to Menu</button>
</form>

<div>
    <?php foreach ($menu_items as $item): ?>
    <div>
        <h3><?= $item['name'] ?></h3>
        <p>$<?= number_format($item['price'], 2) ?></p>
        <p><?= $item['category'] ?></p>
        <p><?= $item['description'] ?></p>
        <?php if ($item['image_path']): ?>
            <img src="../public/<?= $item['image_path'] ?>" alt="<?= $item['name'] ?>">
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
