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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kimlik Bilgileri</title>
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
$sql = "SELECT * FROM kimlikbilgileri WHERE tcNo = ?"; 
$stmt = $conn ->prepare($sql);
$stmt->bind_param('s', $tcNo);
$stmt->execute();
$result = $stmt->get_result();


        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Kimlik No</th>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Baba Adı</th>
                        <th>Anne Adı</th>
                        <th>Doğum Yeri</th>
                        <th>Doğum Tarihi</th>
                        <th>Bağlı Olduğu Baro</th>
                        <th>TBB No</th>
                        <th>Vergi No</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["tcNo"]."</td>
                        <td>".$row["ad"]."</td>
                        <td>".$row["soyad"]."</td>
                        <td>".$row["babaAdi"]."</td>
                        <td>".$row["anneAdi"]."</td>
                        <td>".$row["dogumYeri"]."</td>
                        <td>".$row["dogumTarihi"]."</td>
                        <td>".$row["bagliBaro"]."</td>
                        <td>".$row["tbbNo"]."</td>
                        <td>".$row["vergiNo"]."</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "Veritabanında kimlik bilgisi bulunamadı.";
        }
        $conn->close();
        ?>
    </div>
    <div class="button-container">
        <button onclick="location.href='/final_projesi/iletisim_bilgileri.php'">İletişim Bilgileri</button>
        <button onclick="location.href='/final_projesi/bilgilerimi_guncelle2.php'">Bilgilerimi Güncelle</button>
        </div>
</body>
</html>
