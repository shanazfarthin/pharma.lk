<?php
include 'connection.php';

// ================= COUNTS =================
$totalCustomers = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM customer")
)['total'];

$todayCustomers = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as total FROM customer WHERE DATE(DOB)=CURDATE()")
)['total'];

$customers = mysqli_query($conn, "SELECT * FROM customer ORDER BY cus_id DESC LIMIT 10");
?>

<!DOCTYPE html>
<html>
<head>
<title>PharmaCare Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

/* ================= BASE ================= */
body{
    margin:0;
    font-family:Poppins, sans-serif;
    background:#f4f7fb;
}

/* ================= LAYOUT ================= */
.wrapper{
    display:flex;
}

/* ================= SIDEBAR ================= */
.sidebar{
    width:250px;
    background:#0f766e;
    color:#fff;
    height:100vh;
    position:fixed;
    padding:20px;
    transition:0.3s;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:#fff;
    text-decoration:none;
    padding:12px;
    margin:5px 0;
    border-radius:8px;
}

.sidebar a:hover{
    background:#115e59;
}

/* ================= MAIN ================= */
.main{
    margin-left:250px;
    padding:20px;
    width:100%;
}

/* ================= TOP BAR (MOBILE) ================= */
.topbar{
    display:none;
    background:#0f766e;
    color:#fff;
    padding:15px;
    align-items:center;
    justify-content:space-between;
}

.menu-btn{
    font-size:24px;
    cursor:pointer;
}

/* ================= CARDS ================= */
.cards{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.card{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

/* ================= TABLE ================= */
table{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
    background:#fff;
    border-radius:10px;
    overflow:hidden;
}

th,td{
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:left;
}

th{
    background:#0f766e;
    color:#fff;
}

/* ================= RESPONSIVE ================= */

/* Tablet */
@media(max-width:992px){
    .cards{
        grid-template-columns:1fr 1fr;
    }
}

/* Mobile */
@media(max-width:768px){

    .sidebar{
        left:-260px;
        position:fixed;
    }

    .sidebar.active{
        left:0;
    }

    .main{
        margin-left:0;
    }

    .topbar{
        display:flex;
    }

    .cards{
        grid-template-columns:1fr;
    }

}

</style>

</head>

<body>

<!-- ================= TOP BAR (MOBILE) ================= -->
<div class="topbar">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <h3>PharmaCare</h3>
</div>

<div class="wrapper">

<!-- ================= SIDEBAR ================= -->
<div class="sidebar" id="sidebar">

<h2>💊 PharmaCare</h2>

<a href="#">Dashboard</a>
<a href="#">Customers</a>
<a href="#">Medicine Stock</a>
<a href="#">Sales</a>
<a href="#">Reports</a>
<a href="#">Logout</a>

</div>

<!-- ================= MAIN ================= -->
<div class="main">

<h1>Admin Dashboard</h1>

<!-- ================= CARDS ================= -->
<div class="cards">

<div class="card">
<h3>Total Customers</h3>
<h1><?php echo $totalCustomers; ?></h1>
</div>

<div class="card">
<h3>Today Registrations</h3>
<h1><?php echo $todayCustomers; ?></h1>
</div>

<div class="card">
<h3>System Status</h3>
<h1>Active</h1>
</div>

</div>

<!-- ================= TABLE ================= -->
<h2 style="margin-top:30px;">Recent Customers</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Gender</th>
<th>City</th>
<th>Contact</th>
<th>Email</th>
</tr>

<?php while($row = mysqli_fetch_assoc($customers)){ ?>

<tr>
<td><?php echo $row['cus_id']; ?></td>
<td><?php echo $row['fl_name']; ?></td>
<td><?php echo $row['gender']; ?></td>
<td><?php echo $row['city']; ?></td>
<td><?php echo $row['con_no']; ?></td>
<td><?php echo $row['email']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</div>

<script>

// ================= MOBILE MENU TOGGLE =================
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("active");
}

</script>

</body>
</html>