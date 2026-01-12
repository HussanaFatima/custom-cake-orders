<?php
require_once '../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Fetch counts for stats
$total_q = mysqli_query($conn, "SELECT COUNT(*) as total FROM orders");
$total = mysqli_fetch_assoc($total_q)['total'];

$pending_q = mysqli_query($conn, "SELECT COUNT(*) as p FROM orders WHERE status='Pending'");
$pending = mysqli_fetch_assoc($pending_q)['p'];

$completed_q = mysqli_query($conn, "SELECT COUNT(*) as c FROM orders WHERE status='Completed'");
$completed = mysqli_fetch_assoc($completed_q)['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Custom Creations</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
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
    --warning: #f39c12;
    --danger: #e74c3c;
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
}

/* HEADER */
header {
    background: var(--cyprus-dark);
    color: white;
    padding: 1.5rem 2.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.header-title {
    font-size: 1.5rem;
    font-weight: 700;
    font-family: 'Playfair Display', serif;
}

.header-title i {
    color: var(--accent-gold);
    margin-right: 0.8rem;
}

.header-user {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.header-user strong {
    color: var(--accent-gold);
}

header a {
    color: var(--accent-gold);
    text-decoration: none;
    font-weight: 700;
    transition: color 0.3s;
    padding: 0.6rem 1.5rem;
    border-radius: 8px;
    border: 2px solid var(--accent-gold);
}

header a:hover {
    background: var(--accent-gold);
    color: var(--cyprus-dark);
}

/* STATS CONTAINER */
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    padding: 3rem 2.5rem;
    max-width: 1600px;
    margin: 0 auto;
}

.stat-card {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 70, 67, 0.1);
    border-left: 6px solid var(--cyprus);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 28px rgba(0, 70, 67, 0.15);
}

.stat-card.pending {
    border-left-color: var(--warning);
}

.stat-card.completed {
    border-left-color: var(--success);
}

.stat-card small {
    color: #888;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.stat-card h2 {
    margin: 1rem 0 0 0;
    color: var(--cyprus);
    font-size: 2.5rem;
    font-family: 'Playfair Display', serif;
}

/* CONTAINER */
.container {
    padding: 2rem 2.5rem;
    max-width: 1600px;
    margin: 0 auto;
}

/* QUICK ACTIONS */
.quick-actions {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    margin-bottom: 3rem;
    box-shadow: 0 4px 20px rgba(0, 70, 67, 0.1);
}

.quick-actions h3 {
    font-family: 'Playfair Display', serif;
    color: var(--cyprus);
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
}

.action-buttons {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, var(--cyprus) 0%, var(--cyprus-light) 100%);
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(0, 70, 67, 0.2);
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0, 70, 67, 0.3);
}

.action-btn i {
    font-size: 1.2rem;
}

/* SEARCH */
.search-box {
    width: 100%;
    padding: 1.2rem 1.5rem;
    border: 2px solid var(--sand-dark);
    border-radius: 16px;
    font-size: 1rem;
    margin-bottom: 2.5rem;
    background: white;
    transition: all 0.3s ease;
}

.search-box:focus {
    outline: none;
    border-color: var(--cyprus);
    box-shadow: 0 0 0 4px rgba(0, 70, 67, 0.08);
}

/* SECTION TITLE */
.section-title {
    background: var(--cyprus-dark);
    color: white;
    padding: 1.5rem 2rem;
    border-radius: 16px 16px 0 0;
    margin-bottom: 0;
    font-size: 1.5rem;
    font-family: 'Playfair Display', serif;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.section-title i {
    color: var(--accent-gold);
}

/* TABLE WRAPPER */
.table-wrapper {
    width: 100%;
    overflow-x: auto;
    background: white;
    border-radius: 0 0 16px 16px;
    box-shadow: 0 4px 20px rgba(0, 70, 67, 0.1);
    margin-bottom: 3rem;
    padding-bottom: 1rem;
}

table {
    width: 100%;
    min-width: 1400px;
    border-collapse: collapse;
}

th {
    background: var(--sand-light);
    padding: 1rem;
    text-align: left;
    font-size: 0.85rem;
    text-transform: uppercase;
    color: var(--cyprus);
    font-weight: 700;
    letter-spacing: 0.5px;
    border-bottom: 3px solid var(--cyprus);
}

td {
    padding: 1rem;
    border-bottom: 1px solid var(--sand-dark);
    vertical-align: middle;
    max-width: 250px;
}

tr:hover {
    background: var(--sand-light);
}

.order-no {
    font-weight: 700;
    color: var(--cyprus);
    min-width: 120px;
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
}

.order-image {
    width: 70px;
    height: 70px;
    border-radius: 12px;
    object-fit: cover;
    cursor: zoom-in;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.description-cell {
    max-width: 200px;
    font-size: 0.85rem;
    color: #555;
    line-height: 1.5;
    overflow: hidden;
    text-overflow: ellipsis;
}

.items-cell {
    max-width: 200px;
    font-size: 0.85rem;
    line-height: 1.5;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* BADGE */
.badge {
    display: inline-block;
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    text-align: center;
    white-space: nowrap;
}

.badge.Pending {
    background: #fff3cd;
    color: #856404;
    border: 2px solid #ffc107;
}

.badge.Confirmed {
    background: #d1ecf1;
    color: #0c5460;
    border: 2px solid #17a2b8;
}

.badge.Completed {
    background: #d4edda;
    color: #155724;
    border: 2px solid #28a745;
}

/* ACTIONS */
.actions {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
    min-width: 200px;
}

.action-row {
    display: flex;
    gap: 0.8rem;
    flex-wrap: wrap;
}

select, button {
    padding: 0.65rem 0.9rem;
    border-radius: 10px;
    border: 2px solid var(--sand-dark);
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    font-family: 'Lato', sans-serif;
    font-weight: 600;
}

select {
    flex: 1;
    min-width: 110px;
    background: white;
}

select:focus {
    outline: none;
    border-color: var(--cyprus);
    box-shadow: 0 0 0 3px rgba(0, 70, 67, 0.1);
}

.receipt-btn {
    background: var(--sand-light);
    border: 2px solid var(--sand-dark);
    padding: 0.65rem 1.2rem;
    border-radius: 10px;
    cursor: pointer;
    width: 100%;
    margin-bottom: 0.6rem;
    font-weight: 700;
    color: var(--cyprus);
    transition: all 0.3s ease;
    font-size: 0.85rem;
}

.receipt-btn:hover {
    background: var(--cyprus);
    color: white;
    border-color: var(--cyprus);
    transform: translateY(-2px);
}

.receipt-btn i {
    margin-right: 0.5rem;
}

.save {
    background: var(--success);
    color: white;
    border: 2px solid var(--success);
    font-weight: 700;
    min-width: 70px;
}

.save:hover {
    background: #229954;
    border-color: #229954;
    transform: translateY(-2px);
}

.delete {
    background: var(--danger);
    color: white;
    border: 2px solid var(--danger);
    font-weight: 700;
    width: 100%;
}

.delete:hover {
    background: #c0392b;
    border-color: #c0392b;
    transform: translateY(-2px);
}

/* DASHBOARD GRID */
.dashboard-grid {
    display: flex;
    flex-direction: column;
    gap: 3rem;
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    th, td {
        padding: 0.8rem;
        font-size: 0.8rem;
    }

    .order-image {
        width: 60px;
        height: 60px;
    }
}

@media (max-width: 768px) {
    header {
        padding: 1.2rem 1.5rem;
    }

    .container {
        padding: 1.5rem;
    }

    .stats-container {
        padding: 2rem 1.5rem;
        grid-template-columns: 1fr;
    }

    .action-buttons {
        flex-direction: column;
    }

    .action-btn {
        width: 100%;
        justify-content: center;
    }

    th, td {
        padding: 0.7rem 0.5rem;
        font-size: 0.8rem;
    }

    .order-image {
        width: 50px;
        height: 50px;
    }
}

@media (max-width: 480px) {
    .header-title {
        font-size: 1.2rem;
    }

    .stat-card h2 {
        font-size: 2rem;
    }

    .section-title {
        font-size: 1.2rem;
        padding: 1.2rem 1.5rem;
    }
}
</style>
</head>

<body>

<header>
    <div class="header-title">
        <i class="fas fa-crown"></i> Custom Creations Admin
    </div>
    <div class="header-user">
        <span>Welcome, <strong><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></strong></span>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</header>

<div class="stats-container">
    <div class="stat-card">
        <small>Total Orders</small>
        <h2><?= $total ?></h2>
    </div>
    
    <div class="stat-card pending">
        <small>Pending Requests</small>
        <h2><?= $pending ?></h2>
    </div>
    
    <div class="stat-card completed">
        <small>Completed</small>
        <h2><?= $completed ?></h2>
    </div>
</div>

<div class="container">
    <div class="quick-actions">
        <h3>Quick Actions</h3>
        <div class="action-buttons">
            <a href="manage_products.php" class="action-btn">
                <i class="fas fa-cake-candles"></i> Manage Products
            </a>
            <a href="admin_dashboard.php" class="action-btn">
                <i class="fas fa-refresh"></i> Refresh Dashboard
            </a>
        </div>
    </div>

    <input type="text" id="orderSearch" onkeyup="searchOrders()" placeholder="Search by Order No or Customer Name..." class="search-box">

    <div class="dashboard-grid">
        <div class="order-section">
            <h3 class="section-title">
                <i class="fas fa-shopping-cart"></i> Standard Cart Orders
            </h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>WhatsApp</th>
                            <th>Items</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_cart = mysqli_query($conn, "SELECT * FROM orders WHERE image IS NULL OR image = '' ORDER BY id DESC");
                        while($row = mysqli_fetch_assoc($q_cart)):
                        ?>
                        <tr>
                            <td><span class="order-no"><?= $row['order_no'] ?></span></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['whatsapp']) ?></td>
                            <td><div class="items-cell"><?= nl2br(htmlspecialchars($row['details'])) ?></div></td>
                            <td><span class="badge <?= $row['status'] ?>"><?= $row['status'] ?></span></td>
                            <td>
                                <div class="actions">
                                    <button type="button" class="receipt-btn" 
                                        onclick="printInvoice('<?= $row['order_no'] ?>', '<?= addslashes($row['name']) ?>', '<?= $row['whatsapp'] ?>', '<?= addslashes($row['details'] ?? $row['category']) ?>')">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                    
                                    <form method="POST" action="update_status.php" class="action-row">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <select name="status" required>
                                            <option value="Pending" <?= ($row['status']=="Pending")?"selected":"" ?>>Pending</option>
                                            <option value="Confirmed" <?= ($row['status']=="Confirmed")?"selected":"" ?>>Confirmed</option>
                                            <option value="Completed" <?= ($row['status']=="Completed")?"selected":"" ?>>Completed</option>
                                        </select>
                                        <button type="submit" class="save">Save</button>
                                    </form>

                                    <form method="POST" action="delete_order.php" onsubmit="return confirm('Delete this order?');">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="order-section">
            <h3 class="section-title">
                <i class="fas fa-magic"></i> Custom Design Requests
            </h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Request No</th>
                            <th>Customer</th>
                            <th>WhatsApp</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_custom = mysqli_query($conn, "SELECT * FROM orders WHERE image IS NOT NULL AND image != '' ORDER BY id DESC");
                        while($row = mysqli_fetch_assoc($q_custom)):
                        ?>
                        <tr>
                            <td><span class="order-no"><?= $row['order_no'] ?></span></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['whatsapp']) ?></td>
                            <td>
                                <a href="../uploads/cakes/<?= $row['image'] ?>" target="_blank">
                                    <img src="../uploads/cakes/<?= $row['image'] ?>" class="order-image">
                                </a>
                            </td>
                            <td><?= htmlspecialchars($row['category']) ?></td>
                            <td>
                                <div class="description-cell">
                                    <?= !empty($row['details']) ? nl2br(htmlspecialchars($row['details'])) : '<em style="color: #999;">No description</em>' ?>
                                </div>
                            </td>
                            <td><span class="badge <?= $row['status'] ?>"><?= $row['status'] ?></span></td>
                            <td>
                                <div class="actions">
                                    <form method="POST" action="update_status.php" class="action-row">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <select name="status" required>
                                            <option value="Pending" <?= ($row['status']=="Pending")?"selected":"" ?>>Pending</option>
                                            <option value="Confirmed" <?= ($row['status']=="Confirmed")?"selected":"" ?>>Confirmed</option>
                                            <option value="Completed" <?= ($row['status']=="Completed")?"selected":"" ?>>Completed</option>
                                        </select>
                                        <button type="submit" class="save">Save</button>
                                    </form>

                                    <form method="POST" action="delete_order.php" onsubmit="return confirm('Delete this order?');">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function searchOrders() {
    var input = document.getElementById("orderSearch");
    var filter = input.value.toUpperCase();
    var tr = document.getElementsByTagName("tr");
    
    for (var i = 1; i < tr.length; i++) {
        var td0 = tr[i].getElementsByTagName("td")[0];
        var td1 = tr[i].getElementsByTagName("td")[1];
        
        if (td0 || td1) {
            var txtValue = (td0.textContent || td0.innerText) + (td1.textContent || td1.innerText);
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function printInvoice(orderNo, name, phone, details) {
    const printWindow = window.open('', '_blank', 'height=600,width=800');
    
    printWindow.document.write(`
        <html>
        <head>
            <title>Receipt - ${orderNo}</title>
            <style>
                body { font-family: 'Courier New', monospace; padding: 40px; line-height: 1.6; color: #333; }
                .receipt-container { border: 3px solid #004643; padding: 30px; max-width: 550px; margin: auto; }
                .header { text-align: center; border-bottom: 2px dashed #004643; margin-bottom: 25px; padding-bottom: 15px; }
                .header h2 { color: #004643; font-size: 1.8rem; margin: 0; }
                .item-row { margin: 15px 0; }
                .footer { text-align: center; margin-top: 40px; font-size: 13px; font-style: italic; color: #666; }
                @media print { .no-print { display: none; } }
            </style>
        </head>
        <body>
            <div class="receipt-container">
                <div class="header">
                    <h2>CUSTOM CREATIONS</h2>
                    <p>Artisan Cakes & Premium Creations</p>
                    <p><strong>Order Receipt</strong></p>
                </div>
                
                <div class="item-row"><strong>Order ID:</strong> ${orderNo}</div>
                <div class="item-row"><strong>Customer:</strong> ${name}</div>
                <div class="item-row"><strong>Contact:</strong> ${phone}</div>
                <hr style="border: none; border-top: 2px dashed #004643; margin: 20px 0;">
                
                <div class="item-row"><strong>Order Details:</strong></div>
                <p style="white-space: pre-wrap; margin-left: 20px;">${details}</p>
                
                <div class="footer">
                    <p>Thank you for choosing Custom Creations!</p>
                    <p>${new Date().toLocaleString()}</p>
                </div>
            </div>
            
            <div class="no-print" style="text-align:center; margin-top:30px;">
                <button onclick="window.print()" style="padding:12px 30px; cursor:pointer; background:#004643; color:white; border:none; border-radius:8px; font-weight:bold;">Print Receipt</button>
            </div>

            <script>
                window.onload = function() { 
                    setTimeout(() => { window.print(); }, 500);
                };
            <\/script>
        </body>
        </html>
    `);
    printWindow.document.close();
}
</script>

</body>
</html>