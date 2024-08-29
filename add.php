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
        $davaci = $_POST['davaci'];
        $davali = $_POST['davali'];
        $dava_tarihi = $_POST['dava_tarihi'];
        $dava_konusu = $_POST['dava_konusu'];
        $mahkeme = $_POST['mahkeme'];
        $esas_no = $_POST['esas_no'];
        $dosya_durumu = $_POST['dosya_durumu'];

        $sql = "INSERT INTO hukukdosyaları (davaci, davali, dava_tarihi, dava_konusu, mahkeme, esas_no, dosya_durumu)
                VALUES (:davaci, :davali, :dava_tarihi, :dava_konusu, :mahkeme, :esas_no, :dosya_durumu)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':davaci', $davaci);
        $stmt->bindParam(':davali', $davali);
        $stmt->bindParam(':dava_tarihi', $dava_tarihi);
        $stmt->bindParam(':dava_konusu', $dava_konusu);
        $stmt->bindParam(':mahkeme', $mahkeme);
        $stmt->bindParam(':esas_no', $esas_no);
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