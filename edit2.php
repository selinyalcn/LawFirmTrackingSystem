<?php
// Veritabanı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_projesi";

try {
    // PDO bağlantısı
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
    exit();
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Güncelleme sorgusu
        $sorgu = "UPDATE icradosyaları SET alacakli=:alacakli, borclu=:borclu, takip_tarihi=:takip_tarihi, icra_dairesi=:icra_dairesi, esas_no=:esas_no, takip_miktari=:takip_miktari, takibin_konusu=:takibin_konusu, dosya_durumu=:dosya_durumu WHERE id=:id";
        $stmt = $conn->prepare($sorgu);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->bindParam(':alacakli', $_POST['alacakli']);
        $stmt->bindParam(':borclu', $_POST['borclu']);
        $stmt->bindParam(':takip_tarihi', $_POST['takip_tarihi']);
        $stmt->bindParam(':icra_dairesi', $_POST['icra_dairesi']);
        $stmt->bindParam(':esas_no', $_POST['esas_no']);
        $stmt->bindParam(':takip_miktari', $_POST['takip_miktari']);
        $stmt->bindParam(':takibin_konusu', $_POST['takibin_konusu']);
        $stmt->bindParam(':dosya_durumu', $_POST['dosya_durumu']);
        if ($stmt->execute()) {
            echo "Dosya bilgileri güncellendi.";
        } else {
            echo "Dosya bilgileri güncellenemedi.";
        }
    } catch(PDOException $exception) {
        die('HATA: ' . $exception->getMessage());
    }
} else {
    echo "POST verileri alınamadı.";
}
?>
<?