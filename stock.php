<?php
include 'connection.php';

// ================= ADD MEDICINE =================
if(isset($_POST['add_medicine'])){

    $med_name = $_POST['med_name'];
    $category = $_POST['category'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $exp_date = $_POST['exp_date'];

    mysqli_query($conn, "INSERT INTO medicine (
        med_name, category, qty, price, exp_date
    ) VALUES (
        '$med_name', '$category', '$qty', '$price', '$exp_date'
    )");

    echo "<script>alert('Medicine Added Successfully');</script>";
}

// ================= FETCH MEDICINES =================
$result = mysqli_query($conn, "SELECT * FROM medicine ORDER BY med_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Medicine Stock - PharmaCare</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

/* ================= LAYOUT ================= */
body{
    font-family:Poppins;
    background:#f4f7fb;
    margin:0;
}

/* TOP BAR */
.topbar{
    background:#0f766e;
    color:#fff;
    padding:15px;
    font-size:20px;
}

/* CONTAINER */
.container{
    display:flex;
    gap:20px;
    padding:20px;
    flex-wrap:wrap;
}

/* FORM BOX */
.form-box{
    flex:1;
    min-width:280px;
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

/* TABLE BOX */
.table-box{
    flex:2;
    min-width:300px;
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

/* INPUTS */
input{
    width:100%;
    padding:10px;
    margin:6px 0;
    border:1px solid #ccc;
    border-radius:8px;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    background:#0f766e;
    color:#fff;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:left;
}

th{
    background:#0f766e;
    color:#fff;
}

/* LOW STOCK WARNING */
.low-stock{
    color:red;
    font-weight:bold;
}

/* RESPONSIVE */
@media(max-width:768px){
    .container{
        flex-direction:column;
    }
}

</style>

</head>

<body>

<div class="topbar">
💊 Pharmacy ERP - Medicine Stock Module
</div>

<div class="container">

<!-- ================= ADD MEDICINE FORM ================= -->
<div class="form-box">

<h3>Add Medicine</h3>

<form method="POST">

<input type="text" name="med_name" placeholder="Medicine Name" required>

<input type="text" name="category" placeholder="Category (Tablet, Syrup)" required>

<input type="number" name="qty" placeholder="Quantity" required>

<input type="number" step="0.01" name="price" placeholder="Price" required>

<input type="date" name="exp_date" required>

<button type="submit" name="add_medicine">Add Medicine</button>

</form>

</div>

<!-- ================= STOCK TABLE ================= -->
<div class="table-box">

<h3>Medicine Stock List</h3>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Category</th>
<th>Qty</th>
<th>Price</th>
<th>Expiry</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['med_id']; ?></td>
<td><?php echo $row['med_name']; ?></td>
<td><?php echo $row['category']; ?></td>

<!-- LOW STOCK ALERT -->
<td>
<?php if($row['qty'] <= 10){ ?>
    <span class="low-stock"><?php echo $row['qty']; ?> (Low)</span>
<?php } else { ?>
    <?php echo $row['qty']; ?>
<?php } ?>
</td>

<td><?php echo $row['price']; ?></td>
<td><?php echo $row['exp_date']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>