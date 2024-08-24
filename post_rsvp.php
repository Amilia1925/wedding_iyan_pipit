<?php
// Atur zona waktu ke WIB (Waktu Indonesia Barat)
date_default_timezone_set('Asia/Jakarta');

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ip";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari request POST
$name = $_POST['name'];
$jumlah = $_POST['jumlah'];
$status = $_POST['status'];
$created_at = date('Y-m-d H:i:s'); // Menambahkan tanggal dan waktu saat ini

// SQL untuk memasukkan data
$sql = "INSERT INTO rsvp (name, jumlah, status, phone_number, created_at) VALUES ('$name', $jumlah, $status, '', '$created_at')";

if ($conn->query($sql) === TRUE) {
    // Mengembalikan respon JSON jika sukses
    echo json_encode(array("status" => "success", "message" => "Data successfully processed!"));
} else {
    // Mengembalikan respon JSON jika gagal
    echo json_encode(array("status" => "error", "message" => "Error: " . $conn->error));
}

// Tutup koneksi
$conn->close();
?>
