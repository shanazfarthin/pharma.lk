<?php
include 'connection.php';

// ================= ADD TO CART SESSION =================
session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

// ================= ADD ITEM =================
if(isset($_POST['add_cart'])){

    $med_id = $_POST['med_id'];
    $qty = $_POST['qty'];

    $med = mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT * FROM medicine WHERE med_id='$med_id'"
    ));

    $item = [
        "med_id" => $med_id,
        "name" => $med['med_name'],
        "price" => $med['price'],
        "qty" => $qty,
        "subtotal" => $med['price'] * $qty
    ];

    $_SESSION['cart'][] = $item;
}

// ================= REMOVE ITEM =================
if(isset($_GET['remove'])){
    unset($_SESSION['cart'][$_GET['remove']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// ================= SAVE BILL =================
if(isset($_POST['save_bill'])){

    $total = 0;

    foreach($_SESSION['cart'] as $item){
        $total += $item['subtotal'];
    }

    mysqli_query($conn, "INSERT INTO bill(total) VALUES('$total')");
    $bill_id = mysqli_insert_id($conn);

    foreach($_SESSION['cart'] as $item){

        mysqli_query($conn, "INSERT INTO bill_items(
            bill_id, med_id, qty, price, subtotal
        ) VALUES(
            '$bill_id',
            '{$item['med_id']}',
            '{$item['qty']}',
            '{$item['price']}',
            '{$item['subtotal']}'
        )");

        // Reduce stock
        mysqli_query($conn, "UPDATE medicine 
            SET qty = qty - {$item['qty']} 
            WHERE med_id='{$item['med_id']}'"
        );
    }

    $_SESSION['cart'] = [];

    echo "<script>alert('Bill Generated Successfully');window.location='billing.php';</script>";
}

// ================= MEDICINES =================
$medicines = mysqli_query($conn, "SELECT * FROM medicine");

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Billing System - PharmaCare</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

body{
    font-family:Poppins;
    background:#f4f7fb;
    margin:0;
}

.header{
    background:#0f766e;
    color:#fff;
    padding:15px;
    font-size:20px;
}

/* LAYOUT */
.container{
    display:flex;
    gap:20px;
    padding:20px;
    flex-wrap:wrap;
}

/* LEFT PANEL */
.box{
    flex:1;
    min-width:300px;
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

/* INPUTS */
select,input{
    width:100%;
    padding:10px;
    margin:6px 0;
    border-radius:8px;
    border:1px solid #ccc;
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
}

th{
    background:#0f766e;
    color:#fff;
}

/* TOTAL */
.total{
    font-size:20px;
    font-weight:bold;
    margin-top:10px;
}

@media(max-width:768px){
    .container{
        flex-direction:column;
    }
}

</style>

</head>

<body>

<div class="header">
💊 Pharmacy ERP - Billing System
</div>

<div class="container">

<!-- ================= ADD ITEMS ================= -->
<div class="box">

<h3>Add Medicine to Cart</h3>

<form method="POST">

<select name="med_id" required>
<option value="">Select Medicine</option>

<?php while($m = mysqli_fetch_assoc($medicines)){ ?>
<option value="<?php echo $m['med_id']; ?>">
<?php echo $m['med_name']; ?> - Rs.<?php echo $m['price']; ?>
</option>
<?php } ?>

</select>

<input type="number" name="qty" placeholder="Quantity" required>

<button name="add_cart">Add to Cart</button>

</form>

</div>

<!-- ================= CART ================= -->
<div class="box">

<h3>Invoice Cart</h3>

<table>

<tr>
<th>Medicine</th>
<th>Qty</th>
<th>Price</th>
<th>Subtotal</th>
<th>Action</th>
</tr>

<?php foreach($_SESSION['cart'] as $index => $item){ 

$total += $item['subtotal'];
?>

<tr>
<td><?php echo $item['name']; ?></td>
<td><?php echo $item['qty']; ?></td>
<td><?php echo $item['price']; ?></td>
<td><?php echo $item['subtotal']; ?></td>
<td><a href="?remove=<?php echo $index; ?>">❌</a></td>
</tr>

<?php } ?>

</table>

<div class="total">
Total: Rs. <?php echo $total; ?>
</div>

<form method="POST">
<button name="save_bill">Generate Bill</button>
</form>

</div>

</div>

</body>
</html>