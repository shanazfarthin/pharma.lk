<?php
include 'connection.php';

// ================= AUTO ITEM ID =================
$result = mysqli_query($conn,
"SELECT item_no FROM item_master ORDER BY item_no DESC LIMIT 1");

if(mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_assoc($result);

    $num = (int)substr($row['item_no'],3) + 1;

    $item_no = "ITM" . str_pad($num,4,"0",STR_PAD_LEFT);

}else{

    $item_no = "ITM0001";
}

// ================= AJAX INSERT =================
if(isset($_POST['ajax'])){

    $errors = [];

    $item_no = $_POST['item_no'];
    $item_name = trim($_POST['item_name']);
    $description = trim($_POST['description']);
    $brand = trim($_POST['brand']);
    $unit_measurement = trim($_POST['unit_measurement']);
    $manufacturer_country = trim($_POST['manufacturer_country']);
    $pack_size = trim($_POST['pack_size']);
    $unit_cost = trim($_POST['unit_cost']);
    $unit_price = trim($_POST['unit_price']);

    // ================= VALIDATION =================
    if($item_name == "")
        $errors['item_name'] = "Required";

    if($description == "")
        $errors['description'] = "Required";

    if($brand == "")
        $errors['brand'] = "Required";

    if($unit_measurement == "")
        $errors['unit_measurement'] = "Required";

    if($manufacturer_country == "")
        $errors['manufacturer_country'] = "Required";

    if($pack_size == "" || !is_numeric($pack_size))
        $errors['pack_size'] = "Numeric only";

    if($unit_cost == "" || !is_numeric($unit_cost))
        $errors['unit_cost'] = "Numeric only";

    if($unit_price == "" || !is_numeric($unit_price))
        $errors['unit_price'] = "Numeric only";

    // ================= RETURN ERRORS =================
    if(!empty($errors)){

        echo json_encode([
            "status" => "error",
            "errors" => $errors
        ]);

        exit;
    }

    // ================= INSERT QUERY =================
    $sql = "INSERT INTO item_master(
        item_no,
        item_name,
        description,
        brand,
        unit_measurement,
        manufacturer_country,
        pack_size,
        unit_cost,
        unit_price
    ) VALUES(
        '$item_no',
        '$item_name',
        '$description',
        '$brand',
        '$unit_measurement',
        '$manufacturer_country',
        '$pack_size',
        '$unit_cost',
        '$unit_price'
    )";

    if(mysqli_query($conn,$sql)){

        echo json_encode([
            "status" => "success"
        ]);

    }else{

        echo json_encode([
            "status" => "error",
            "db_error" => mysqli_error($conn)
        ]);
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Item Master Creation</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial, Helvetica, sans-serif;
    background:#eef2f7;
}

/* ================= HEADER ================= */

.header{
    background:#0f766e;
    color:white;
    padding:18px;
    text-align:center;
    font-size:28px;
    font-weight:bold;
    letter-spacing:1px;
}

/* ================= CONTAINER ================= */

.container{
    width:100%;
    max-width:1100px;
    margin:30px auto;
    padding:20px;
}

/* ================= FORM BOX ================= */

.form-box{
    background:white;
    padding:35px;
    border-radius:15px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

/* ================= FORM TITLE ================= */

.form-title{
    font-size:24px;
    margin-bottom:25px;
    color:#0f766e;
    text-align:center;
    font-weight:bold;
}

/* ================= GRID ================= */

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:22px;
}

.full{
    grid-column:1 / 3;
}

/* ================= FORM GROUP ================= */

.form-group{
    display:flex;
    flex-direction:column;
}

/* ================= LABEL ================= */

label{
    margin-bottom:8px;
    font-weight:600;
    color:#333;
}

/* ================= INPUT ================= */

input,
select,
textarea{
    width:100%;
    padding:12px 14px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    font-size:15px;
    transition:0.3s;
    background:#fff;
}

textarea{
    resize:none;
    height:100px;
}

input:focus,
select:focus,
textarea:focus{
    border-color:#0f766e;
    outline:none;
    box-shadow:0 0 5px rgba(15,118,110,0.3);
}

/* ================= READONLY ================= */

input[readonly]{
    background:#f1f5f9;
    font-weight:bold;
}

/* ================= ERROR ================= */

.error{
    color:red;
    font-size:13px;
    margin-top:5px;
    min-height:18px;
}

/* ================= BUTTON ================= */

.btn{
    margin-top:30px;
}

button{
    width:100%;
    padding:14px;
    background:#0f766e;
    color:white;
    border:none;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#115e59;
}

/* ================= MOBILE RESPONSIVE ================= */

@media(max-width:768px){

    .form-grid{
        grid-template-columns:1fr;
    }

    .full{
        grid-column:1 / 2;
    }

    .form-box{
        padding:20px;
    }

    .header{
        font-size:22px;
    }
}

</style>

</head>

<body>

<!-- ================= HEADER ================= -->

<div class="header">
    💊 Pharmacy ERP System
</div>

<!-- ================= MAIN CONTAINER ================= -->

<div class="container">

    <div class="form-box">

        <div class="form-title">
            Item Master Creation
        </div>

        <!-- ================= FORM ================= -->

        <form id="itemForm">

            <input type="hidden" name="ajax" value="1">

            <div class="form-grid">

                <!-- ITEM NO -->
                <div class="form-group">

                    <label>Item No</label>

                    <input type="text"
                           name="item_no"
                           value="<?php echo $item_no; ?>"
                           readonly>

                </div>

                <!-- ITEM NAME -->
                <div class="form-group">

                    <label>Item Name</label>

                    <input type="text" name="item_name">

                    <div class="error" id="item_name"></div>

                </div>

                <!-- DESCRIPTION -->
                <div class="form-group full">

                    <label>Description</label>

                    <textarea name="description"></textarea>

                    <div class="error" id="description"></div>

                </div>

                <!-- BRAND -->
                <div class="form-group">

                    <label>Brand</label>

                    <input type="text" name="brand">

                    <div class="error" id="brand"></div>

                </div>

                <!-- UNIT -->
                <div class="form-group">

                    <label>Unit of Measurement</label>

                    <select name="unit_measurement">

                        <option value="">Select Unit</option>
                        <option>Tablet</option>
                        <option>Capsule</option>
                        <option>Bottle</option>
                        <option>Syrup</option>
                        <option>Tube</option>

                    </select>

                    <div class="error" id="unit_measurement"></div>

                </div>

                <!-- COUNTRY -->
                <div class="form-group">

                    <label>Manufacturer Country</label>

                    <input type="text" name="manufacturer_country">

                    <div class="error" id="manufacturer_country"></div>

                </div>

                <!-- PACK SIZE -->
                <div class="form-group">

                    <label>Pack Size</label>

                    <input type="text" name="pack_size">

                    <div class="error" id="pack_size"></div>

                </div>

                <!-- UNIT COST -->
                <div class="form-group">

                    <label>Unit Cost</label>

                    <input type="text" name="unit_cost">

                    <div class="error" id="unit_cost"></div>

                </div>

                <!-- UNIT PRICE -->
                <div class="form-group">

                    <label>Unit Price</label>

                    <input type="text" name="unit_price">

                    <div class="error" id="unit_price"></div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="btn">

                <button type="submit">
                    Save Item
                </button>

            </div>

        </form>

    </div>

</div>

<!-- ================= AJAX SCRIPT ================= -->

<script>

document.getElementById("itemForm")
.addEventListener("submit", function(e){

    e.preventDefault();

    let formData = new FormData(this);

    fetch("",{
        method:"POST",
        body:formData
    })

    .then(res => res.json())

    .then(data => {

        // CLEAR ERRORS
        document.querySelectorAll(".error")
        .forEach(el => el.innerHTML = "");

        // VALIDATION ERRORS
        if(data.status === "error"){

            for(let key in data.errors){

                document.getElementById(key)
                .innerHTML = data.errors[key];
            }

            if(data.db_error){

                alert(data.db_error);
            }
        }

        // SUCCESS
        if(data.status === "success"){

            alert("Item Saved Successfully");

            location.reload();
        }

    });

});

</script>

</body>
</html>