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

// Query SQL untuk mengambil nilai tertinggi in_motor dan in_mobil
$sql = "SELECT MAX(in_motor) AS max_in_motor, MAX(in_mobil) AS max_in_mobil FROM sensor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $max_in_motor = $row['max_in_motor'];
  $max_in_mobil = $row['max_in_mobil'];

  // Query SQL untuk mengambil data berdasarkan nilai tertinggi in_motor dan in_mobil
  $sql = "SELECT * FROM sensor WHERE in_motor = '$max_in_motor' AND in_mobil = '$max_in_mobil'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Buat array kosong untuk menyimpan data kendaraan
    $kendaraanArray = array();

    // Loop melalui setiap baris hasil query
    while ($row = $result->fetch_assoc()) {
      // Tambahkan data kendaraan ke dalam array
      $kendaraanArray[] = $row;
    }

    // Ubah array ke dalam format JSON
    $jsonOutput = json_encode($kendaraanArray);

    // Tampilkan output JSON
    echo $jsonOutput;
  } else {
    // Jika tidak ada hasil, kirimkan pesan bahwa tidak ada data yang ditemukan
    echo "Tidak ada data yang ditemukan";
  }
} else {
  // Jika tidak ada hasil, kirimkan pesan bahwa tidak ada data yang ditemukan
  echo "Tidak ada data yang ditemukan";
}

// Tutup koneksi database
$conn->close();
?>