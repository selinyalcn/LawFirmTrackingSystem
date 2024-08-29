<?php
// Veritabanı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_projesi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $alacakli = $_POST['alacakli'];
        $borclu = $_POST['borclu'];
        $takip_tarihi = $_POST['takip_tarihi'];
        $icra_dairesi = $_POST['icra_dairesi'];
        $esas_no = $_POST['esas_no'];
        $takip_miktari = $_POST['takip_miktari'];
        $takibin_konusu = $_POST['takibin_konusu'];
        $dosya_durumu = $_POST['dosya_durumu'];

        $sql = "INSERT INTO icradosyaları (alacakli, borclu, takip_tarihi, icra_dairesi, esas_no, takip_miktari, takibin_konusu, dosya_durumu)
                VALUES (:alacakli, :borclu, :takip_tarihi, :icra_dairesi, :esas_no, :takip_miktari, :takibin_konusu, :dosya_durumu)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':alacakli', $alacakli);
        $stmt->bindParam(':borclu', $borclu);
        $stmt->bindParam(':takip_tarihi', $takip_tarihi);
        $stmt->bindParam(':icra_dairesi', $icra_dairesi);
        $stmt->bindParam(':esas_no', $esas_no);
        $stmt->bindParam(':takip_miktari', $takip_miktari);
        $stmt->bindParam(':takibin_konusu', $takibin_konusu);
        $stmt->bindParam(':dosya_durumu', $dosya_durumu);

        if ($stmt->execute()) {
            echo "Yeni dosya eklendi.";
        } else {
            echo "Dosya eklenemedi.";
        }
    }
} catch (PDOException $exception) {
    die('HATA: ' . $exception->getMessage());
}
?>
<?   