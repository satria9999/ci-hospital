<?php
$servername = "localhost";
$username = "u1576116_satria";
$password = "kelompok.4";
$dbname = "u1576116_hospital";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query SQL untuk mengambil data atribut alamat_image
$sql = "SELECT alamat_image FROM sliderimage";
$result = $conn->query($sql);

$response = array(); // Inisialisasi array untuk menampung data

if ($result->num_rows > 0) {
    // Loop melalui setiap baris hasil query
    while ($row = $result->fetch_assoc()) {
        // Ambil alamat gambar dari baris saat ini
        $alamatImage = $row['alamat_image'];
        
        // Tambahkan alamat gambar ke dalam array response
        $response[] = $alamatImage;
    }
} else {
    // Jika tidak ada hasil, kirimkan pesan bahwa tidak ada data yang ditemukan
    $response['error'] = "No images found.";
}

// Tutup koneksi database
$conn->close();

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
