<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_projesi";
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Formdan gelen verileri al
$id = $_POST["id"];
$kasa = $_POST["kasa"];
$gelir_gider_turu = $_POST["gelir_gider_türü"];
$borc = $_POST["borc"];
$alacak = $_POST["alacak"];
$tarih = $_POST["tarih"];
$aciklama = $_POST["aciklama"];

// Veriyi güncelle
$sql = "UPDATE makbuzgörüntüleme SET kasa='$kasa', gelir_gider_türü='$gelir_gider_turu', borc='$borc', alacak='$alacak', tarih='$tarih', aciklama='$aciklama' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Veri başarıyla güncellendi";
} else {
    echo "Güncelleme hatası: " . $conn->error;
}

$conn->close();
?>
<?