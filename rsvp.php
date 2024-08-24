<?php
// submit_rsvp.php

// Konfigurasi database
$servername = "localhost"; // Biasanya "localhost"
$username = "root"; // Nama pengguna database Anda
$password = ""; // Kata sandi database Anda
$dbname = "rsvp_db"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menangani pengiriman form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['no_hp'];
    $number_of_guests = $_POST['jumlah'];
    $attendance_status = $_POST['status'];
    $event_id = $_POST['event_id'];
    $invitation_id = $_POST['invitation_id'];
    $stepper_id = $_POST['stepper_id'];

    // Mencegah SQL Injection
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $phone_number = $conn->real_escape_string($phone_number);
    $number_of_guests = $conn->real_escape_string($number_of_guests);
    $attendance_status = $conn->real_escape_string($attendance_status);
    $event_id = $conn->real_escape_string($event_id);
    $invitation_id = $conn->real_escape_string($invitation_id);
    $stepper_id = $conn->real_escape_string($stepper_id);

    // SQL untuk menyimpan data
    $sql = "INSERT INTO rsvp (name, email, phone_number, number_of_guests, attendance_status, event_id, invitation_id, stepper_id) 
            VALUES ('$name', '$email', '$phone_number', '$number_of_guests', '$attendance_status', '$event_id', '$invitation_id', '$stepper_id')";

    $response = array();

    if ($conn->query($sql) === TRUE) {
        $response['status'] = "success";
        $response['message'] = "New record created successfully";
        $response['data'] = array(
            'send_rsvp_qrcode' => 1, // atau 0, sesuai logika aplikasi Anda
            'status' => 1, // atau 0, sesuai logika aplikasi Anda
            'whatsapp_rsvp' => 1 // atau 0, sesuai logika aplikasi Anda
        );
    } else {
        $response['status'] = "error";
        $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request"));
}
?>
