<?php
// Veritabanı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_projesi";

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// POST isteği ile gelen id parametresini al
$id = $_POST['id'];

// SQL sorgusunu hazırla ve kaydı sil
$sql = "DELETE FROM makbuzgörüntüleme WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Kayıt başarıyla silindi.";
} else {
    echo "Silme hatası: " . $conn->error;
}

// Bağlantıyı kapat
$conn->close();
?>
<?