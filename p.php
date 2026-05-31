<?php
include 'connection.php';

/* ================= AUTO PO ID ================= */
$result = mysqli_query($conn,
"SELECT po_id FROM purchase_order ORDER BY po_id DESC LIMIT 1");

if(mysqli_num_rows($result)>0){

    $row = mysqli_fetch_assoc($result);
    $num = (int)substr($row['po_id'],3)+1;
    $po_id = "PO".str_pad($num,4,"0",STR_PAD_LEFT);

}else{
    $po_id = "PO0001";
}

/* ================= LOAD DATA ================= */
$vendors = mysqli_query($conn,"SELECT vendor_id, vendor_name FROM vendor");
$items = mysqli_query($conn,"SELECT item_no, item_name FROM item_master");


/* ================= AJAX INSERT ================= */
if(isset($_POST['ajax'])){

    $vendor_id = $_POST['vendor_id'];
    $po_date = date("Y-m-d");

    $items_data = $_POST['items']; // array
    $errors = [];

    if($vendor_id=="") $errors['vendor_id']="Required";

    if(empty($items_data)) $errors['items']="Add at least one item";

    if(!empty($errors)){
        echo json_encode(["status"=>"error","errors"=>$errors]);
        exit;
    }

    /* ================= CALCULATE TOTAL ================= */
    $total = 0;

    foreach($items_data as $it){
        $total += $it['qty'] * $it['unit_price'];
    }

    /* ================= INSERT PO HEADER ================= */
    $sql1 = "INSERT INTO purchase_order(po_id,vendor_id,po_date,total_amount)
             VALUES('$po_id','$vendor_id','$po_date','$total')";

    mysqli_query($conn,$sql1);

    /* ================= INSERT ITEMS ================= */
    foreach($items_data as $it){

        $item_no = $it['item_no'];
        $qty = $it['qty'];
        $unit_price = $it['unit_price'];
        $line_total = $qty * $unit_price;

        $sql2 = "INSERT INTO purchase_order_items(po_id,item_no,qty,unit_price,line_total)
                 VALUES('$po_id','$item_no','$qty','$unit_price','$line_total')";

        mysqli_query($conn,$sql2);
    }

    echo json_encode(["status"=>"success"]);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Purchase Order</title>

<style>
body{font-family:Arial;background:#eef2f7;margin:0;}

.header{
    background:#0f766e;color:white;padding:18px;text-align:center;
    font-size:24px;font-weight:bold;
}

.container{max-width:1100px;margin:30px auto;padding:20px;}

.form-box{background:white;padding:25px;border-radius:12px;}

input,select{
    padding:10px;margin:5px;border:1px solid #ccc;border-radius:8px;
}

table{width:100%;margin-top:15px;border-collapse:collapse;}

th,td{border:1px solid #ddd;padding:10px;text-align:center;}

button{
    background:#0f766e;color:white;padding:10px;border:none;
    border-radius:8px;cursor:pointer;margin-top:10px;
}
</style>
</head>

<body>

<div class="header">📦 Purchase Order</div>

<div class="container">

<div class="form-box">

<form id="poForm">

<input type="hidden" name="ajax" value="1">

<label>PO ID</label>
<input type="text" value="<?php echo $po_id; ?>" readonly>

<label>Vendor</label>
<select name="vendor_id">
    <option value="">Select Vendor</option>
    <?php while($v=mysqli_fetch_assoc($vendors)){ ?>
        <option value="<?php echo $v['vendor_id']; ?>">
            <?php echo $v['vendor_name']; ?>
        </option>
    <?php } ?>
</select>

<h3>Items</h3>

<table id="itemTable">

<tr>
<th>Item</th>
<th>Qty</th>
<th>Unit Price</th>
<th>Action</th>
</tr>

</table>

<button type="button" onclick="addRow()">+ Add Item</button>

<br><br>

<button type="submit">Submit PO</button>

</form>

</div>
</div>

<script>

let itemOptions = `<?php
while($i=mysqli_fetch_assoc($items)){
    echo "<option value='{$i['item_no']}'>{$i['item_name']}</option>";
}
?>`;

function addRow(){

    let table = document.getElementById("itemTable");

    let row = table.insertRow();

    row.innerHTML = `
        <td>
            <select name="item_no[]">
                <option value="">Select</option>
                ${itemOptions}
            </select>
        </td>
        <td><input type="number" name="qty[]" value="1"></td>
        <td><input type="number" name="unit_price[]" value="0"></td>
        <td><button type="button" onclick="this.parentNode.parentNode.remove()">X</button></td>
    `;
}

document.getElementById("poForm").addEventListener("submit",function(e){

    e.preventDefault();

    let formData = new FormData(this);

    let items = [];

    let rows = document.querySelectorAll("#itemTable tr");

    rows.forEach((row,index)=>{

        if(index===0) return;

        let item_no = row.querySelector("select").value;
        let qty = row.querySelectorAll("input")[0].value;
        let unit_price = row.querySelectorAll("input")[1].value;

        if(item_no!=""){
            items.push({item_no,qty,unit_price});
        }
    });

    formData.append("items", JSON.stringify(items));

    fetch("",{
        method:"POST",
        body:formData
    })
    .then(res=>res.json())
    .then(data=>{

        if(data.status==="success"){
            alert("Purchase Order Saved");
            location.reload();
        }

        if(data.status==="error"){
            alert("Error: " + JSON.stringify(data.errors));
        }
    });

});
</script>

</body>
</html>