<?php include "dashboard.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoşgeldiniz - UYAP Bilişim Sistemleri</title>
    <style>
        /* CSS Stil Kodları */
        body {
            font-family: Arial, sans-serif;
            background-color: #797979;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .welcome {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #a9a9a9;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: black;
        }

        /* Tablo stilleri */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="welcome">HOŞGELDİNİZ  <?php echo $username; ?> </h1>
        <h1 class="welcome"> SEMSS Bilişim Sistemleri</h1>
        <p class="welcome">Kişisel bilgileriniz:</p>
        <div class="button-container">
            <button onclick="location.href='/final_projesi/kimlik_bilgileri.php'">Kimlik Bilgileri</button>
            <!-- Bilgileri Güncelle butonu -->
            <button onclick="location.href='/final_projesi/bilgilerimi_guncelle.php'">Bilgilerimi Güncelle</button>
        </div>
        <div class="container">
            <?php
            // Veritabanı bağlantısı yapılacak
            // Örnek bağlantı bilgileri
           $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "final_projesi";

            // Bağlantı oluşturma
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Bağlantı kontrolü
            if ($conn->connect_error) {
                die("Bağlantı hatası: " . $conn->connect_error);
            }

            // Kimlik bilgilerini çekme sorgusu
            $tcNo = $_SESSION['tcNo'];
            $sql = "SELECT FROM kimlikbilgileri WHERE tcNo = $tcNo";
            $result = $conn->query($sql);


        
            $conn->close();
            ?>
        </div>
        <div class="button-container">
        <button onclick="location.href='/final_projesi/iletisim_bilgileri.php'">İletişim Bilgileri</button>
        <button onclick="location.href='/final_projesi/bilgilerimi_guncelle2.php'">Bilgilerimi Güncelle</button>
         
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
}

// T.C. Kimlik No bilgisini al
$tcNo = $_SESSION['tcNo'];

// Kayıt bilgilerini al
try {
    $sorgu = "SELECT * FROM iletisimbilgileri WHERE tcNo = :tcNo";
    $stmt = $con->prepare($sorgu);
    $stmt->bindParam(':tcNo', $tcNo);
    $stmt->execute(); 
    $kayit = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "HATA: " . $e->getMessage();
}

// Form gönderildiğinde
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    try{ 
        // güncelleme sorgusu 
        $sorgu = "UPDATE iletisimbilgileri SET adres=:adres, eposta=:eposta, telefonNo=:telefonNo WHERE tcNo =:tcNo"; 
        $stmt = $con->prepare($sorgu); 
        $stmt->bindParam(':tcNo', $tcNo);
        $stmt->bindParam(':adres', $_POST['adres']); 
        $stmt->bindParam(':eposta', $_POST['eposta']); 
        $stmt->bindParam(':telefonNo', $_POST['telefonNo']); 
        if($stmt->execute()){ 
            echo "<div class='alert alert-success'>İletişim bilgileri güncellendi.</div>";
        } else { 
            echo "<div class='alert alert-danger'>İletişim bilgileri güncellenemedi.</div>"; 
        } 
    } catch(PDOException $exception){ 
        die('HATA: ' . $exception->getMessage()); 
    } 
} 
?>

<div class="container">
    <h1 class="welcome">İletişim Bilgilerimi Güncelle</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
        <table>
            <tr> 
                <td>Adres</td> 
                <td><input type='text' name='adres' value="<?php echo isset($kayit['adres']) ? htmlspecialchars($kayit['adres'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
            </tr> 
            <tr> 
                <td>Eposta</td> 
                <td><input type='text' name='eposta' value="<?php echo isset($kayit['eposta']) ? htmlspecialchars($kayit['eposta'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
            </tr> 
            <tr> 
                <td>Telefon No</td> 
                <td><input type='text' name='telefonNo' value="<?php echo isset($kayit['telefonNo']) ? htmlspecialchars($kayit['telefonNo'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
            </tr> 
            <tr> 
                <td colspan='2'> 
                    <input type='submit' value='Güncelle' class='btn btn-primary' /> 
                </td> 
            </tr> 
        </table> 
    </form>
    </div>



        </div>
    </div>
</body>
</html>
