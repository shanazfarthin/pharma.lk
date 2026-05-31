<?php
include 'connection.php'; // calling DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cus_id = $_POST['cus_id'];
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $s_name = $_POST['s_name'];
    $fl_name = $_POST['fl_name'];
    $gender = $_POST['gender'];
    $DOB = $_POST['DOB'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $con_no = $_POST['con_no'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // secure password

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Insert query
    $sql = "INSERT INTO customer (
        cus_id, f_name, m_name, s_name, fl_name,
        gender, DOB, age, address, city,
        con_no, email, pass
    ) VALUES (
        '$cus_id', '$f_name', '$m_name', '$s_name', '$fl_name',
        '$gender', '$DOB', '$age', '$address', '$city',
        '$con_no', '$email', '$pass'
    )";

if (mysqli_query($conn, $sql)) {

    echo "<script>
            alert('Registration Successful!');
           
          </script>";

} else {

    echo "<script>
            alert('Error: " . mysqli_error($conn) . "');
            window.location.href='register.php';
          </script>";
}
    }

?>