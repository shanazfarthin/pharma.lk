<?php
include 'connection.php';

/* ================= AUTO VENDOR ID ================= */
$result = mysqli_query($conn,
"SELECT vendor_id FROM vendor ORDER BY vendor_id DESC LIMIT 1");

if(mysqli_num_rows($result)>0){

    $row = mysqli_fetch_assoc($result);
    $num = (int)substr($row['vendor_id'],3)+1;
    $vendor_id = "VEN".str_pad($num,4,"0",STR_PAD_LEFT);

}else{
    $vendor_id = "VEN0001";
}

/* ================= AJAX INSERT ================= */
if(isset($_POST['ajax'])){

    $errors = [];

    $vendor_id = $_POST['vendor_id'];
    $vendor_name = trim($_POST['vendor_name']);
    $business_registration = trim($_POST['business_registration']);
    $country = trim($_POST['country']);
    $postal_code = trim($_POST['postal_code']);
    $address = trim($_POST['address']);
    $address2 = trim($_POST['address2']);
    $contact_person = trim($_POST['contact_person']);
    $mobile = trim($_POST['mobile']);
    $contact_no = trim($_POST['contact_no']);
    $fax = trim($_POST['fax']);
    $email = trim($_POST['email']);

    if($vendor_name=="") $errors['vendor_name']="Required";
    if($business_registration=="") $errors['business_registration']="Required";
    if($country=="") $errors['country']="Required";
    if($postal_code=="") $errors['postal_code']="Required";
    if($address=="") $errors['address']="Required";
    if($contact_person=="") $errors['contact_person']="Required";

    if(!preg_match("/^[0-9]{10}$/",$mobile))
        $errors['mobile']="Invalid Mobile";

    if(!preg_match("/^[0-9]{10}$/",$contact_no))
        $errors['contact_no']="Invalid Contact";

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors['email']="Invalid Email";

    if(!empty($errors)){
        echo json_encode(["status"=>"error","errors"=>$errors]);
        exit;
    }

    $sql = "INSERT INTO vendor VALUES(
        '$vendor_id','$vendor_name','$business_registration',
        '$country','$postal_code','$address','$address2',
        '$contact_person','$mobile','$contact_no','$fax','$email'
    )";

    if(mysqli_query($conn,$sql)){
        echo json_encode(["status"=>"success"]);
    }else{
        echo json_encode(["status"=>"error","db_error"=>mysqli_error($conn)]);
    }

    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Vendor Registration</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

/* ================= BASE ================= */
body{
    font-family:Arial;
    background:#eef2f7;
    margin:0;
}

/* ================= HEADER ================= */
.header{
    background:#0f766e;
    color:#fff;
    padding:18px;
    text-align:center;
    font-size:24px;
    font-weight:bold;
}

/* ================= CONTAINER ================= */
.container{
    max-width:1100px;
    margin:30px auto;
    padding:20px;
}

/* ================= FORM BOX ================= */
.form-box{
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

/* ================= GRID ================= */
.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.full{
    grid-column:1 / 3;
}

/* ================= FIELD GROUP ================= */
.field{
    display:flex;
    flex-direction:column;
}

label{
    margin-bottom:6px;
    font-weight:600;
    color:#333;
}

/* ================= INPUT ================= */
input,textarea{
    padding:12px;
    border:1px solid #ccc;
    border-radius:10px;
    font-size:14px;
}

textarea{
    height:90px;
    resize:none;
}

/* ================= READONLY ================= */
input[readonly]{
    background:#f1f5f9;
    font-weight:bold;
}

/* ================= ERROR ================= */
.error{
    color:red;
    font-size:12px;
    margin-top:4px;
}

/* ================= BUTTON ================= */
button{
    width:100%;
    padding:14px;
    margin-top:20px;
    background:#0f766e;
    color:#fff;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#115e59;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .form-grid{
        grid-template-columns:1fr;
    }
    .full{
        grid-column:1;
    }
}

</style>

</head>

<body>

<div class="header">
🏭 Vendor Registration - Pharmacy ERP
</div>

<div class="container">

<div class="form-box">

<form id="vendorForm">

<input type="hidden" name="ajax" value="1">

<div class="form-grid">

<!-- VENDOR ID -->
<div class="field">
<label>Vendor ID</label>
<input type="text" name="vendor_id" value="<?php echo $vendor_id; ?>" readonly>
</div>

<!-- VENDOR NAME -->
<div class="field">
<label>Vendor Name</label>
<input type="text" name="vendor_name">
<div class="error" id="vendor_name"></div>
</div>

<!-- BUSINESS REG -->
<div class="field">
<label>Business Registration</label>
<input type="text" name="business_registration">
<div class="error" id="business_registration"></div>
</div>

<!-- COUNTRY -->
<div class="field">
<label>Country</label>
<input type="text" name="country">
<div class="error" id="country"></div>
</div>

<!-- POSTAL -->
<div class="field">
<label>Postal Code</label>
<input type="text" name="postal_code">
<div class="error" id="postal_code"></div>
</div>

<!-- ADDRESS -->
<div class="field full">
<label>Address</label>
<textarea name="address"></textarea>
<div class="error" id="address"></div>
</div>

<!-- ADDRESS 2 -->
<div class="field full">
<label>Address 2</label>
<textarea name="address2"></textarea>
</div>

<!-- CONTACT PERSON -->
<div class="field">
<label>Contact Person</label>
<input type="text" name="contact_person">
<div class="error" id="contact_person"></div>
</div>

<!-- MOBILE -->
<div class="field">
<label>Mobile</label>
<input type="text" name="mobile">
<div class="error" id="mobile"></div>
</div>

<!-- CONTACT NO -->
<div class="field">
<label>Contact No</label>
<input type="text" name="contact_no">
<div class="error" id="contact_no"></div>
</div>

<!-- FAX -->
<div class="field">
<label>Fax</label>
<input type="text" name="fax">
</div>

<!-- EMAIL -->
<div class="field full">
<label>Email</label>
<input type="text" name="email">
<div class="error" id="email"></div>
</div>

</div>

<button type="submit">Save Vendor</button>

</form>

</div>

</div>

<script>

document.getElementById("vendorForm")
.addEventListener("submit", function(e){

    e.preventDefault();

    let formData = new FormData(this);

    fetch("",{
        method:"POST",
        body:formData
    })
    .then(res=>res.json())
    .then(data=>{

        document.querySelectorAll(".error")
        .forEach(e=>e.innerHTML="");

        if(data.status==="error"){
            for(let key in data.errors){
                document.getElementById(key).innerHTML=data.errors[key];
            }
        }

        if(data.status==="success"){
            alert("Vendor Saved Successfully");
            location.reload();
        }

    });

});

</script>

</body>
</html>