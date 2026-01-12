<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Handle Delete Action
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    $res = mysqli_query($conn, "SELECT image FROM products WHERE id = $id");
    $row = mysqli_fetch_assoc($res);
    if ($row && file_exists("../uploads/" . $row['image'])) {
        unlink("../uploads/" . $row['image']);
    }
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header("Location: manage_products.php?msg=deleted");
    exit;
}

// Handle Edit Product
if (isset($_POST['edit_product'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    
    // Check if new image uploaded
    if (!empty($_FILES['image']['name'])) {
        // Delete old image
        $old_img = mysqli_query($conn, "SELECT image FROM products WHERE id = $id");
        $old_row = mysqli_fetch_assoc($old_img);
        if ($old_row && file_exists("../uploads/" . $old_row['image'])) {
            unlink("../uploads/" . $old_row['image']);
        }
        
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        
        $sql = "UPDATE products SET item_name='$name', price='$price', category='$category', description='$desc', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE products SET item_name='$name', price='$price', category='$category', description='$desc' WHERE id=$id";
    }
    
    mysqli_query($conn, $sql);
    header("Location: manage_products.php?msg=updated");
    exit;
}

// Handle Add Product Action
if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    
    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO products (item_name, price, category, description, image) VALUES ('$name', '$price', '$category', '$desc', '$image')";
        mysqli_query($conn, $sql);
        header("Location: manage_products.php?msg=added");
    }
}

// Get product for editing if edit parameter exists
$edit_product = null;
if (isset($_GET['edit'])) {
    $edit_id = mysqli_real_escape_string($conn, $_GET['edit']);
    $edit_res = mysqli_query($conn, "SELECT * FROM products WHERE id = $edit_id");
    $edit_product = mysqli_fetch_assoc($edit_res);
}

$products = mysqli_query($conn, "SELECT * FROM products ORDER BY category, id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management | Custom Creations</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Lato:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --cyprus: #004643;
            --cyprus-light: #006662;
            --cyprus-dark: #003330;
            --sand-dune: #F0EDE5;
            --sand-dark: #E5DFD4;
            --sand-light: #FAF8F4;
            --accent-gold: #C9A961;
            --text-dark: #2C2C2C;
            --white: #FFFFFF;
            --success: #27ae60;
            --danger: #e74c3c;
            --info: #3498db;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: var(--sand-dune);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 300px;
            background: linear-gradient(180deg, var(--cyprus-dark) 0%, #002220 100%);
            color: white;
            padding: 3rem 2rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 28px rgba(0, 0, 0, 0.2);
        }

        .sidebar-header {
            margin-bottom: 3.5rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid rgba(201, 169, 97, 0.2);
        }

        .sidebar h2 {
            font-family: 'Playfair Display', serif;
            color: var(--accent-gold);
            margin-bottom: 0.8rem;
            font-size: 2rem;
            font-weight: 800;
        }

        .sidebar-subtitle {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 400;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            display: flex;
            align-items: center;
            gap: 1.2rem;
            padding: 1.2rem 1.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 14px;
            margin-bottom: 0.8rem;
            font-weight: 600;
        }

        .nav-link i {
            font-size: 1.3rem;
            width: 28px;
        }

        .nav-link:hover {
            background: rgba(201, 169, 97, 0.15);
            color: white;
            transform: translateX(8px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--accent-gold), #D4B973);
            color: var(--cyprus-dark);
            font-weight: 700;
            box-shadow: 0 4px 16px rgba(201, 169, 97, 0.3);
        }

        .nav-link.logout {
            margin-top: 4rem;
            color: #ff6b6b;
            border: 2px solid rgba(255, 107, 107, 0.3);
        }

        .nav-link.logout:hover {
            background: rgba(255, 107, 107, 0.1);
            border-color: #ff6b6b;
        }

        /* CONTENT AREA */
        .content {
            margin-left: 300px;
            flex: 1;
            padding: 3.5rem;
        }

        .page-header {
            margin-bottom: 3.5rem;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            font-size: 3.2rem;
            margin-bottom: 0.8rem;
            font-weight: 800;
        }

        .page-header p {
            color: #666;
            font-size: 1.1rem;
        }

        /* SUCCESS MESSAGE */
        .success-msg {
            background: linear-gradient(135deg, var(--success), #229954);
            color: white;
            padding: 1.2rem 2rem;
            border-radius: 14px;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            animation: slideDown 0.5s ease-out;
            box-shadow: 0 4px 16px rgba(39, 174, 96, 0.3);
        }

        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .success-msg i {
            font-size: 1.5rem;
        }

        /* CARD */
        .card {
            background: white;
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 70, 67, 0.12);
            margin-bottom: 3.5rem;
        }

        .card h3 {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            margin-bottom: 2.5rem;
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            font-weight: 700;
        }

        .card h3 i {
            color: var(--accent-gold);
            font-size: 1.8rem;
        }

        /* FORM */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .form-group {
            grid-column: span 2;
        }

        .form-group.half {
            grid-column: span 1;
        }

        label {
            display: block;
            font-weight: 700;
            color: var(--cyprus);
            margin-bottom: 0.9rem;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        input, select, textarea {
            width: 100%;
            padding: 1.1rem 1.4rem;
            border-radius: 14px;
            border: 2px solid var(--sand-dark);
            font-size: 1rem;
            font-family: 'Lato', sans-serif;
            transition: all 0.3s ease;
            background: var(--sand-light);
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--cyprus);
            box-shadow: 0 0 0 4px rgba(0, 70, 67, 0.08);
            background: white;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23004643' d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.2rem center;
            cursor: pointer;
        }

        input[type="file"] {
            padding: 1rem;
            cursor: pointer;
            background: white;
        }

        .note {
            font-size: 0.88rem;
            color: #666;
            margin-top: 0.6rem;
            font-style: italic;
        }

        .btn {
            padding: 1.1rem 2.8rem;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: 'Lato', sans-serif;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
        }

        .btn-add {
            background: linear-gradient(135deg, var(--cyprus), var(--cyprus-light));
            color: white;
            width: 100%;
            margin-top: 1.5rem;
            box-shadow: 0 6px 20px rgba(0, 70, 67, 0.25);
            justify-content: center;
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(0, 70, 67, 0.35);
        }

        .btn-edit {
            background: var(--info);
            color: white;
            padding: 0.75rem 1.8rem;
            font-size: 0.9rem;
            box-shadow: 0 4px 16px rgba(52, 152, 219, 0.25);
            margin-right: 0.8rem;
        }

        .btn-edit:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.35);
        }

        .btn-delete {
            background: var(--danger);
            color: white;
            padding: 0.75rem 1.8rem;
            font-size: 0.9rem;
            box-shadow: 0 4px 16px rgba(231, 76, 60, 0.25);
        }

        .btn-delete:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.35);
        }

        .btn-cancel {
            background: #95a5a6;
            color: white;
            padding: 1.1rem 2.8rem;
            margin-left: 1rem;
        }

        .btn-cancel:hover {
            background: #7f8c8d;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }

        th {
            background: var(--sand-light);
            padding: 1.3rem 1rem;
            text-align: left;
            font-size: 0.85rem;
            text-transform: uppercase;
            color: var(--cyprus);
            font-weight: 700;
            letter-spacing: 0.5px;
            border-bottom: 3px solid var(--cyprus);
        }

        td {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid var(--sand-dark);
            vertical-align: middle;
        }

        tr:hover {
            background: var(--sand-light);
        }

        .thumb {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .product-name {
            font-weight: 700;
            color: var(--cyprus);
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .product-desc {
            font-size: 0.9rem;
            color: #666;
            margin-top: 0.4rem;
        }

        .category-badge {
            display: inline-block;
            background: linear-gradient(135deg, rgba(201, 169, 97, 0.15), rgba(212, 185, 115, 0.15));
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--cyprus);
            border: 2px solid var(--accent-gold);
        }

        .price-tag {
            font-weight: 700;
            color: var(--accent-gold);
            font-size: 1.3rem;
            font-family: 'Playfair Display', serif;
        }

        .action-buttons {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .empty-state {
            text-align: center;
            padding: 4rem;
            color: #666;
        }

        .empty-state i {
            font-size: 5rem;
            color: rgba(0, 70, 67, 0.15);
            margin-bottom: 1.5rem;
        }

        .empty-state h4 {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            font-size: 1.8rem;
            margin-bottom: 0.8rem;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .sidebar {
                width: 260px;
            }

            .content {
                margin-left: 260px;
                padding: 2.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.half {
                grid-column: span 1;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 2rem 1.5rem;
            }

            .content {
                margin-left: 0;
                padding: 2rem 1.5rem;
            }

            .page-header h1 {
                font-size: 2.5rem;
            }

            .card {
                padding: 2rem;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 1rem 0.6rem;
            }

            .thumb {
                width: 70px;
                height: 70px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-edit, .btn-delete {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>Custom Creations</h2>
        <p class="sidebar-subtitle">Product Management Portal</p>
    </div>
    
    <nav>
        <a href="admin_dashboard.php" class="nav-link">
            <i class="fas fa-chart-line"></i>
            Dashboard Overview
        </a>
        <a href="manage_products.php" class="nav-link active">
            <i class="fas fa-cake-candles"></i>
            Manage Products
        </a>
        <a href="../logout.php" class="nav-link logout">
            <i class="fas fa-sign-out-alt"></i>
            Sign Out
        </a>
    </nav>
</div>

<div class="content">
    <div class="page-header">
        <h1>Product Inventory</h1>
        <p>Curate your artisan collection with precision</p>
    </div>

    <?php if(isset($_GET['msg'])): ?>
        <div class="success-msg">
            <i class="fas fa-check-circle"></i>
            <span>
                <?php 
                if($_GET['msg'] == 'added') echo 'Product successfully added to inventory!';
                if($_GET['msg'] == 'updated') echo 'Product successfully updated!';
                if($_GET['msg'] == 'deleted') echo 'Product successfully removed from inventory!';
                ?>
            </span>
        </div>
    <?php endif; ?>

    <div class="card">
        <h3>
            <i class="fas <?= $edit_product ? 'fa-edit' : 'fa-plus-circle' ?>"></i> 
            <?= $edit_product ? 'Edit Product' : 'Add New Masterpiece' ?>
        </h3>
        <form method="POST" enctype="multipart/form-data">
            <?php if($edit_product): ?>
                <input type="hidden" name="id" value="<?= $edit_product['id'] ?>">
            <?php endif; ?>
            
            <div class="form-grid">
                <div class="form-group half">
                    <label>Product Name</label>
                    <input type="text" name="name" placeholder="e.g. Chocolate Velvet Dream" 
                           value="<?= $edit_product['item_name'] ?? '' ?>" required>
                </div>
                
                <div class="form-group half">
                    <label>Price (PKR)</label>
                    <input type="number" name="price" placeholder="e.g. 3500" 
                           value="<?= $edit_product['price'] ?? '' ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" required>
                        <option value="">Select Category</option>
                        <option value="Signature Cakes" <?= ($edit_product && $edit_product['category']=='Signature Cakes')?'selected':'' ?>>Signature Cakes</option>
                        <option value="Custom Designs" <?= ($edit_product && $edit_product['category']=='Custom Designs')?'selected':'' ?>>Custom Designs</option>
                        <option value="Cupcakes & Treats" <?= ($edit_product && $edit_product['category']=='Cupcakes & Treats')?'selected':'' ?>>Cupcakes & Treats</option>
                        <option value="Seasonal Specials" <?= ($edit_product && $edit_product['category']=='Seasonal Specials')?'selected':'' ?>>Seasonal Specials</option>
                        <option value="Premium Collection" <?= ($edit_product && $edit_product['category']=='Premium Collection')?'selected':'' ?>>Premium Collection</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Product Description</label>
                    <textarea name="description" placeholder="Describe the flavor profile, ingredients, and what makes this creation special..." rows="3"><?= $edit_product['description'] ?? '' ?></textarea>
                    <p class="note">Help customers understand what makes this creation unique</p>
                </div>
                
                <div class="form-group">
                    <label>Product Image <?= $edit_product ? '(Upload new to replace)' : '' ?></label>
                    <input type="file" name="image" accept="image/jpeg, image/png" <?= $edit_product ? '' : 'required' ?>>
                    <p class="note">High-quality images recommended (JPG/PNG, Max 5MB)</p>
                    <?php if($edit_product && $edit_product['image']): ?>
                        <p class="note" style="margin-top: 1rem;">Current image: <strong><?= $edit_product['image'] ?></strong></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <button type="submit" name="<?= $edit_product ? 'edit_product' : 'add_product' ?>" class="btn btn-add" style="flex: 1;">
                    <i class="fas <?= $edit_product ? 'fa-save' : 'fa-sparkles' ?>"></i> 
                    <?= $edit_product ? 'Update Product' : 'Add to Collection' ?>
                </button>
                <?php if($edit_product): ?>
                    <a href="manage_products.php" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card">
        <h3><i class="fas fa-layer-group"></i> Current Collection</h3>
        
        <?php if(mysqli_num_rows($products) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($products)): ?>
                    <tr>
                        <td>
                            <?php if(!empty($row['image'])): ?>
                                <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" class="thumb" alt="Product">
                            <?php else: ?>
                                <div style="width: 90px; height: 90px; background: var(--sand-light); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="color: #ccc; font-size: 2rem;"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="product-name"><?= htmlspecialchars($row['item_name']) ?></div>
                            <?php if(!empty($row['description'])): ?>
                                <div class="product-desc">
                                    <?= htmlspecialchars(substr($row['description'], 0, 70)) ?>...
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="category-badge"><?= htmlspecialchars($row['category']) ?></span>
                        </td>
                        <td>
                            <span class="price-tag">Rs. <?= number_format($row['price']) ?></span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="manage_products.php?edit=<?= $row['id'] ?>" class="btn btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="manage_products.php?delete=<?= $row['id'] ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('Remove this item from your collection?')">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <h4>No Products Yet</h4>
                <p>Start building your collection by adding your first masterpiece above</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>