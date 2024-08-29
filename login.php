<?php
session_start();

// Veritabanı bağlantısı
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "final_projesi";

$conn = new mysqli($servername, $username_db, $password_db, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adına göre şifreyi veritabanından getir
    $sql = "SELECT username, passwordd FROM kullanicilar WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Kullanıcı bulundu, şifreyi doğrula
        $row = $result->fetch_assoc();
        if ($password === $row['passwordd']) {
            // Şifre doğru, oturum başlat ve yönlendir
            session_start();
            $_SESSION['username'] = $row['username'];
            header("Location: index5.php"); // Giriş başarılıysa yönlendirilecek sayfa
            exit();
        } else {
            // Şifre yanlış
            echo "Hatalı kullanıcı adı veya şifre.";
        }
    } else {
        // Kullanıcı bulunamadı
        echo "Kullanıcı bulunamadı.";
    }
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>





<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <style>
        /* CSS Stil Kodları */
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f2f2f2; /* Arkaplan rengi */
    background-image: url('arka_plan_resmi.jpg'); /* Arka plan resmi */
    background-size: cover; /* Resmi kapsamak için */
    background-position: center; /* Resmi ortalamak için */
   
}


.login-box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.8); /* Saydam bir arka plan */
    padding: 40px;
    box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
    border-radius: 10px;
    z-index: 2;
}

        .login-box h2 {
            margin: 0 0 30px;
            padding: 0;
            color: #333; /* Başlık rengi */
            text-align: center;
            z-index: 2;
        }

        .login-box .user-box {
            position: relative;
            margin-bottom: 30px;
            z-index: 2;
        }

        .login-box .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #333; /* Yazı rengi */
            margin-bottom: 5px;
            border: none;
            border-bottom: 1px solid #ccc; /* Alt çizgi rengi */
            outline: none;
            background: transparent;
            z-index: 2;
        }

        .login-box .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: #666; /* Etiket rengi */
            pointer-events: none;
            transition: .5s;
            z-index: 2;
        }

        .login-box .user-box input:focus ~ label,
        .login-box .user-box input:valid ~ label {
            top: -20px;
            left: 0;
            color: #03e9f4; /* Aktif etiket rengi */
            font-size: 12px;
            z-index: 2;
        }

        .login-box form a {
            display: block;
            margin-top: 40px;
            text-align: center;
            color: #333; /* Link rengi */
            text-decoration: none;
            z-index: 2;
        }

        .login-box form a:hover {
            color: #03e9f4; /* Hover link rengi */
            z-index: 2;
        }

        .login-box button {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            background: #03e9f4; /* Buton arka plan rengi */
            color: #fff; /* Buton yazı rengi */
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
            z-index: 2;
        }

        .login-box button:hover {
            background: #00bfff; /* Hover buton arka plan rengi */
            z-index: 2;
        }
        
        .saydam-resim2 {
            /* %50 opaklık */
            position: absolute; /* Resmin pozisyonunu ayarla */
            top: 50%; /* Yukarıdan uzaklık */
            left: 50%; /* Soldan uzaklık */
            transform: translate(-50%, -50%); /* Merkezde hizalama */
            z-index: 1; /* Arkada */
        }
    </style>
</head>
<body>
    <div class="login-box">
    <h2>UYAP HUKUK BÜROSU</h2>
        <h2>GİRİŞ EKRANI</h2>
        <img src="arka_plan_resmi.webp" alt="" class="saydam-resim2">
        <form action="dashboard.php" method="POST">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Kullanıcı Adı</label>
            </div>
            <div class="user-box">
                <input type="password" name="passwordd" required="">
                <label>Şifre</label>
            </div>
            <button type="submit">Giriş Yap</button>
            <a href="#">Şifremi Unuttum</a>
        </form>
    </div>
</body>
</html>
