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

// Query SQL untuk mengambil data dokter
$sql = "SELECT nomer_dokter, nama_dokter, spesialis, gender FROM dokter"; // Sesuaikan dengan nama tabel dan atribut di database Anda
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Buat array kosong untuk menyimpan data dokter
  $dokterArray = array();

  // Loop melalui setiap baris hasil query
  while($row = $result->fetch_assoc()) {
    // Tambahkan data dokter ke dalam array
    $dokterArray[] = $row;
  }

  // Ubah array ke dalam format JSON
  $jsonOutput = json_encode($dokterArray);

  // Tampilkan output JSON
  echo $jsonOutput;
} else {
  // Jika tidak ada hasil, kirimkan pesan bahwa tidak ada data yang ditemukan
  echo "0 results";
}

// Tutup koneksi database
$conn->close();

?>


