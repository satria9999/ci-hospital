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

// Ambil nomor dokter dari parameter GET
$nomerDokter = isset($_GET['nomer_dokter']) ? $_GET['nomer_dokter'] : '';

if ($nomerDokter != '') {
  // Persiapkan pernyataan SQL dengan parameter (?)
  $sql = "SELECT d.nomer_dokter, d.nama_dokter, d.spesialis, rs.nama_rumahsakit, rs.lokasi, d.gender,
                 d.waktu_mulai, d.waktu_selesai
          FROM dokter d
          JOIN rumah_sakit rs ON d.id_rumahsakit = rs.id_rumahsakit
          WHERE d.nomer_dokter = ?";

  // Persiapkan pernyataan SQL menggunakan prepare statement
  $stmt = $conn->prepare($sql);

  // Bind parameter ke pernyataan SQL
  $stmt->bind_param("s", $nomerDokter);

  // Eksekusi pernyataan SQL
  $stmt->execute();

  // Dapatkan hasil query
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Buat array untuk menyimpan detail dokter
    $detailDokterArray = array();

    // Ambil data dari setiap baris hasil query sebagai array asosiatif
    while($row = $result->fetch_assoc()) {
      // Melakukan pemformatan waktu mulai
      $waktuMulai = date('H:i', strtotime($row['waktu_mulai']));
      // Melakukan pemformatan waktu selesai
      $waktuSelesai = date('H:i', strtotime($row['waktu_selesai']));

      // Menambahkan waktu mulai dan waktu selesai ke dalam array
      $row['waktu_mulai'] = $waktuMulai;
      $row['waktu_selesai'] = $waktuSelesai;

      // Menambahkan baris yang telah diformat ke dalam array hasil
      $detailDokterArray[] = $row;
    }

    // Tampilkan output JSON
    echo json_encode($detailDokterArray);
  } else {
    // Jika tidak ada hasil, kirimkan pesan bahwa tidak ada data yang ditemukan
    echo "0 results";
  }

  // Tutup statement
  $stmt->close();
} else {
  // Jika nomor dokter tidak diberikan, kirimkan pesan kesalahan
  echo "Nomor dokter tidak tersedia";
}

// Tutup koneksi database
$conn->close();
?>
