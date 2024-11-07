<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan host database Anda
$username = "u1576116_satria"; // Ganti dengan username database Anda
$password = "kelompok.4"; // Ganti dengan password database Anda
$dbname = "u1576116_hospital"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Ambil data ambulance dari database
$sql = "SELECT * FROM ambulance";
$result = $conn->query($sql);

// Siapkan array untuk menyimpan data ambulance
$ambulanceArray = array();

// Ambil data dari setiap baris hasil query sebagai array asosiatif
while($row = $result->fetch_assoc()) {
  $ambulanceArray[] = $row;
}

// Tutup koneksi database
$conn->close();

// Set header agar browser mengenali respons sebagai JSON
header('Content-Type: application/json');

// Tampilkan data ambulance dalam format JSON
echo json_encode($ambulanceArray);
?>
