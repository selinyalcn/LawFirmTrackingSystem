<?php
// Veritabanı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_projesi";

try {
    // PDO bağlantısı
    $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
    exit();
}

// Form gönderildiğinde
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        // Güncelleme sorgusu
        $sorgu = "UPDATE hukukdosyaları SET davaci=:davaci, davali=:davali, dava_tarihi=:dava_tarihi, dava_konusu=:dava_konusu, mahkeme=:mahkeme, esas_no=:esas_no, dosya_durumu=:dosya_durumu WHERE id=:id";
        $stmt = $con->prepare($sorgu);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->bindParam(':davaci', $_POST['davaci']);
        $stmt->bindParam(':davali', $_POST['davali']);
        $stmt->bindParam(':dava_tarihi', $_POST['dava_tarihi']);
        $stmt->bindParam(':dava_konusu', $_POST['dava_konusu']);
        $stmt->bindParam(':mahkeme', $_POST['mahkeme']);
        $stmt->bindParam(':esas_no', $_POST['esas_no']);
        $stmt->bindParam(':dosya_durumu', $_POST['dosya_durumu']);
        if($stmt->execute()){
            echo "Dosya bilgileri güncellendi.";
        } else {
            echo "Dosya bilgileri güncellenemedi.";
        }
    } catch(PDOException $exception){
        die('HATA: ' . $exception->getMessage());
    }
} else {
    echo "POST verileri alınamadı.";
}
?>
<?