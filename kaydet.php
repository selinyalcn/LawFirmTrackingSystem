<?php
// Veritabanı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_projesi";

// Form verilerini al
$kasa = $_POST["kasa"];
$gelirGiderTuru = $_POST["gelir_gider_turu"];
$tutar = $_POST["tutar"];
$borcAlacak = $_POST["borc_alacak"];
$tarih = $_POST["tarih"];
$aciklama = $_POST["aciklama"];

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// SQL sorgusunu hazırla
$sql = "INSERT INTO makbuzgörüntüleme (kasa, gelir_gider_türü, borc, alacak, tarih, aciklama) VALUES ('$kasa', '$gelirGiderTuru', ";
if ($borcAlacak == "Borç") {
    $sql .= "'$tutar', 0, ";
} else {
    $sql .= "0, '$tutar', ";
}
$sql .= "'$tarih', '$aciklama')";

// Sorguyu çalıştırma
if ($conn->query($sql) === TRUE) {
    // Yeni kayıt eklendikten sonra ana sayfaya yönlendir
    header("Location: makbuzgoruntuleme.php");
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
<?