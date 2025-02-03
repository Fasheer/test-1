<?php
$host = "localhost";
$user = "root"; // Change this if your database has a different username
$pass = ""; // Add your database password
$dbname = "car_rental";

// Connect to MySQL database
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_name = $_POST["car_name"];
    $user_name = $_POST["user_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $price_per_day = $_POST["price_per_day"];

    // Calculate total days
    $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
    
    // Apply discount for rentals of 7 or more days
    $total_price = $days * $price_per_day;
    if ($days >= 7) {
        $total_price *= 0.9;
    }

    $sql = "INSERT INTO bookings (car_name, user_name, email, phone, start_date, end_date, total_price) 
            VALUES ('$car_name', '$user_name', '$email', '$phone', '$start_date', '$end_date', '$total_price')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
