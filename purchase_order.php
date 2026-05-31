<?php

/* ==========================
   DATABASE CONNECTION
========================== */
include 'connection.php';


/* ==========================
   AUTO PO NUMBER
========================== */

$po_no = "PO0001";

$result = mysqli_query($conn,
"SELECT po_id FROM purchase_order ORDER BY po_id DESC LIMIT 1");

if($result && mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_assoc($result);

    $num = $row['po_id'] + 1;

    $po_no = "PO" . str_pad($num, 4, "0", STR_PAD_LEFT);
}


/* ==========================
   MESSAGE VARIABLE
========================== */

$message = "";


/* ==========================
   SAVE PURCHASE ORDER
========================== */

if(isset($_POST['save_po'])){

    $po_no      = mysqli_real_escape_string($conn, $_POST['po_no']);
    $vendor_id  = mysqli_real_escape_string($conn, $_POST['vendor_id']);
    $po_date    = $_POST['po_date'];

    // CHECK ITEM ARRAYS
    if(
        isset($_POST['product_name']) &&
        isset($_POST['qty']) &&
        isset($_POST['unit_price'])
    ){

        $products = $_POST['product_name'];
        $qtys     = $_POST['qty'];
        $prices   = $_POST['unit_price'];

        $grand_total = 0;

        // CALCULATE GRAND TOTAL
        for($i = 0; $i < count($products); $i++){

            $qty   = (float)$qtys[$i];
            $price = (float)$prices[$i];

            $line_total = $qty * $price;

            $grand_total += $line_total;
        }

        // INSERT PURCHASE ORDER HEADER
        $sql = "INSERT INTO purchase_order
                (
                    po_no,
                    vendor_id,
                    po_date,
                    total_amount
                )
                VALUES
                (
                    '$po_no',
                    '$vendor_id',
                    '$po_date',
                    '$grand_total'
                )";

        if(mysqli_query($conn, $sql)){

            // LAST INSERT ID
            $po_id = mysqli_insert_id($conn);

            // INSERT ITEMS
            for($i = 0; $i < count($products); $i++){

                $product = mysqli_real_escape_string(
                    $conn,
                    $products[$i]
                );

                $qty   = (float)$qtys[$i];
                $price = (float)$prices[$i];

                $line_total = $qty * $price;

                $item_sql = "INSERT INTO purchase_order_items
                            (
                                po_id,
                                product_name,
                                qty,
                                unit_price,
                                line_total
                            )
                            VALUES
                            (
                                '$po_id',
                                '$product',
                                '$qty',
                                '$price',
                                '$line_total'
                            )";

                mysqli_query($conn, $item_sql);
            }

            $message = "Purchase Order Saved Successfully";

        }else{

            $message = "Insert Error : " . mysqli_error($conn);
        }

    }else{

        $message = "Please add items";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Purchase Order</title>

<style>

body{
    font-family: Arial;
    background:#f2f2f2;
    padding:20px;
}

.container{
    width:1100px;
    margin:auto;
    background:white;
    padding:20px;
    border-radius:10px;
}

h2{
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th,
table td{
    border:1px solid #ccc;
    padding:10px;
}

input{
    width:100%;
    padding:8px;
    box-sizing:border-box;
}

button{
    padding:10px 15px;
    border:none;
    cursor:pointer;
}

.add-btn{
    background:green;
    color:white;
}

.remove-btn{
    background:red;
    color:white;
}

.save-btn{
    background:blue;
    color:white;
    margin-top:20px;
}

.msg{
    color:green;
    font-weight:bold;
    margin-bottom:20px;
}

</style>

</head>

<body>

<div class="container">

<h2>Purchase Order Entry</h2>

<div class="msg">
    <?php echo $message; ?>
</div>

<form method="POST">

<table>

<tr>

<td width="15%">PO Number</td>

<td width="35%">
<input type="text"
       name="po_no"
       value="<?php echo $po_no; ?>"
       readonly>
</td>

<td width="15%">PO Date</td>

<td width="35%">
<input type="date"
       name="po_date"
       required>
</td>

</tr>

<tr>

<td>Vendor ID</td>

<td colspan="3">
<input type="text"
       name="vendor_id"
       placeholder="Enter Vendor ID"
       required>
</td>

</tr>

</table>

<br>

<table id="itemTable">

<thead>

<tr>

<th width="35%">Product Name</th>

<th width="15%">Quantity</th>

<th width="20%">Unit Price</th>

<th width="20%">Line Total</th>

<th width="10%">Action</th>

</tr>

</thead>

<tbody>

<tr>

<td>
<input type="text"
       name="product_name[]"
       required>
</td>

<td>
<input type="number"
       name="qty[]"
       class="qty"
       min="1"
       required>
</td>

<td>
<input type="number"
       name="unit_price[]"
       class="price"
       step="0.01"
       min="0"
       required>
</td>

<td>
<input type="text"
       class="line_total"
       readonly>
</td>

<td>
<button type="button"
        class="remove-btn"
        onclick="removeRow(this)">
Remove
</button>
</td>

</tr>

</tbody>

</table>

<br>

<button type="button"
        class="add-btn"
        onclick="addRow()">

Add New Item

</button>

<br>

<button type="submit"
        name="save_po"
        class="save-btn">

Save Purchase Order

</button>

</form>

</div>

<script>

/* ==========================
   ADD NEW ROW
========================== */

function addRow(){

    let table =
    document.getElementById("itemTable")
            .getElementsByTagName('tbody')[0];

    let row = table.insertRow();

    row.innerHTML = `

    <td>
        <input type="text"
               name="product_name[]"
               required>
    </td>

    <td>
        <input type="number"
               name="qty[]"
               class="qty"
               min="1"
               required>
    </td>

    <td>
        <input type="number"
               name="unit_price[]"
               class="price"
               step="0.01"
               min="0"
               required>
    </td>

    <td>
        <input type="text"
               class="line_total"
               readonly>
    </td>

    <td>
        <button type="button"
                class="remove-btn"
                onclick="removeRow(this)">
        Remove
        </button>
    </td>

    `;
}


/* ==========================
   REMOVE ROW
========================== */

function removeRow(button){

    let row = button.parentNode.parentNode;

    row.parentNode.removeChild(row);
}


/* ==========================
   AUTO CALCULATE TOTAL
========================== */

document.addEventListener("input", function(e){

    if(
        e.target.classList.contains("qty") ||
        e.target.classList.contains("price")
    ){

        let row = e.target.parentNode.parentNode;

        let qty =
        row.querySelector(".qty").value || 0;

        let price =
        row.querySelector(".price").value || 0;

        let total = qty * price;

        row.querySelector(".line_total").value =
        total.toFixed(2);
    }

});

</script>

</body>
</html>
