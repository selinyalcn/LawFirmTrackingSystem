<?php
session_start();
include "dashboard.php";
?>
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
        <h1 class="welcome">HOŞGELDİNİZ  <?php echo $_SESSION['username']; ?> </h1>
        <h1 class="welcome"> SEMSS Bilişim Sistemleri</h1>
        <p class="welcome">Kişisel bilgileriniz:</p>
        <div class="button-container">
            <button onclick="location.href='/final_projesi/kimlik_bilgileri.php'">Kimlik Bilgileri</button>
            <!-- Bilgileri Güncelle butonu -->
            <button onclick="location.href='/final_projesi/bilgilerimi_guncelle.php'">Bilgilerimi Güncelle</button>
        </div>
        
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
            $sorgu = "SELECT * FROM kimlikbilgileri WHERE tcNo = :tcNo";
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
                $sorgu = "UPDATE kimlikbilgileri SET ad=:ad, soyad=:soyad, babaAdi=:babaAdi, anneAdi=:anneAdi, dogumYeri=:dogumYeri, dogumTarihi=:dogumTarihi, bagliBaro=:bagliBaro, tbbNo=:tbbNo, vergiNo=:vergiNo WHERE tcNo =:tcNo"; 
                $stmt = $con->prepare($sorgu); 
                $stmt->bindParam(':tcNo', $tcNo);
                $stmt->bindParam(':ad', $_POST['ad']); 
                $stmt->bindParam(':soyad', $_POST['soyad']); 
                $stmt->bindParam(':babaAdi', $_POST['babaAdi']); 
                $stmt->bindParam(':anneAdi', $_POST['anneAdi']); 
                $stmt->bindParam(':dogumYeri', $_POST['dogumYeri']); 
                $stmt->bindParam(':dogumTarihi', $_POST['dogumTarihi']); 
                $stmt->bindParam(':bagliBaro', $_POST['bagliBaro']); 
                $stmt->bindParam(':tbbNo', $_POST['tbbNo']); 
                $stmt->bindParam(':vergiNo', $_POST['vergiNo']); 
                if($stmt->execute()){ 
                    echo "<div class='alert alert-success'>Kayıt güncellendi.</div>";
                } else { 
                    echo "<div class='alert alert-danger'>Kayıt güncellenemedi.</div>"; 
                } 
            } catch(PDOException $exception){ 
                die('HATA: ' . $exception->getMessage()); 
            } 
        } 
        ?> 

        <div class="container"> 
            <div class="page-header"> 
                <h1>Bilgilerimi Güncelle</h1> 
            </div> 

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
                <table class='table table-hover table-responsive table-bordered'> 
                    <tr> 
                        <td>Ad</td> 
                        <td><input type='text' name='ad' value="<?php echo isset($kayit['ad']) ? htmlspecialchars($kayit['ad'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
                    </tr> 
                    <tr> 
                        <td>Soyad</td> 
                        <td><input type='text' name='soyad' value="<?php echo isset($kayit['soyad']) ? htmlspecialchars($kayit['soyad'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
                    </tr> 
                    <tr> 
                        <td>Baba Adı</td> 
                        <td><input type='text' name='babaAdi' value="<?php echo isset($kayit['babaAdi']) ? htmlspecialchars($kayit['babaAdi'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
                    </tr> 
                    <tr> 
                        <td>Anne Adı</td> 
                        <td><input type='text' name='anneAdi' value="<?php echo isset($kayit['anneAdi']) ? htmlspecialchars($kayit['anneAdi'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
                    </tr> 
                    <tr> 
                        <td>Doğum Yeri</td> 
                        <td><input type='text' name='dogumYeri' value="<?php echo isset($kayit['dogumYeri']) ? htmlspecialchars($kayit['dogumYeri'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
                    </tr> 
                    <tr> 
                        <td>Doğum Tarihi</td> 
                        <td><input type='text' name='dogumTarihi' value="<?php echo isset($kayit['dogumTarihi']) ? htmlspecialchars($kayit['dogumTarihi'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
                    </tr> 
                    <tr> 
                        <td>Bağlı Olduğu Baro</td> 
                        <td><input type='text' name='bagliBaro' value="<?php echo isset($kayit['bagliBaro']) ? htmlspecialchars($kayit['bagliBaro'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
                    </tr> 
                    <tr> 
                        <td>TBB No</td> 
                        <td><input type='text' name='tbbNo' value="<?php echo isset($kayit['tbbNo']) ? htmlspecialchars($kayit['tbbNo'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
                    </tr> 
                    <tr> 
                        <td>Vergi No</td> 
                        <td><input type='text' name='vergiNo' value="<?php echo isset($kayit['vergiNo']) ? htmlspecialchars($kayit['vergiNo'], ENT_QUOTES) : ''; ?>" class='form-control' /></td> 
                    </tr> 
                    <tr> 
                        <td> 
                            <input type='submit' value='Kaydet' class='btn btn-primary' /> 
                        </td> 
                    </tr> 
                </table> 
            </form>
        </div>

        <div class="button-container">
            <button onclick="location.href='/final_projesi/iletisim_bilgileri.php'">İletişim Bilgileri</button>
            <button onclick="location.href='/final_projesi/bilgilerimi_guncelle2.php'">Bilgilerimi Güncelle</button>
        </div>
    </div>
</body>
</html>
