<?php
session_start();

$servername = "localhost";
$id = "root";
$password = "";
$dbname = "final_projesi";

// Bağlantı oluşturma
$conn = new mysqli($servername, $id, $password, $dbname);

// Oturum kontrolü
if (!isset($_SESSION['username'])) {
  header("Location: login.php"); // Oturum açılmamışsa login sayfasına yönlendir
  exit(); 
}

// Oturum açık ise, kullanıcı adını göster
$username = $_SESSION['username'];

try {
  $sorgu = "SELECT tcNo FROM kullanicilar WHERE username = ?";
  $stmt = $conn -> prepare($sorgu);
  $stmt -> bind_param('s', $username);
  $stmt -> execute(); 
  $result = $stmt -> get_result();


  if ($result->num_rows > 0) {
    $row = $result -> fetch_assoc();
    $_SESSION['tcNo'] = $row['tcNo'];
  } else {
    echo "No Record!";
  }
} catch (PDOException $e) {
  echo "HATA: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kullanıcı Ekranı</title>
  <style>
    /* CSS Stil Kodları */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
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

    .logout {
      text-align: center;
    }

    .logout a {
      color: red;
      text-decoration: none;
    }

    .user-info {
      margin-top: 15px;
      position: absolute;
      top: 0;
      right: 20px;
      line-height: 50px;
    }

    .navbar-collapse {
      background-color: #C0C0C0;
    }
    .logout-button {
      margin-top: 15px;
      position: absolute;
      top: 0;
      right: 20px;
      line-height: 50px;
        }
  </style>
</head>

<body>
  <div class="container">

    <!DOCTYPE html>
    <html lang="tr">

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

      <title>SEMSS Bilişim Sistemleri</title>

      <!-- Bootstrap CSS dosyası -->
      <link rel="stylesheet" href="/proje/content/css/bootstrap.min.css" />
      <link rel="stylesheet" href="/final_projesi/style.css" />
    </head>

    <body class="admin">
      <!-- Menü – Bootstrap Fixed Navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
              aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Kullanıcı logosu ve adını sağ üst köşeye ekleme -->
            <a class="navbar-brand" href="#"><i class="fas fa-user"></i> SEMSS Bilişim Sistemleri</a>


          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/final_projesi/index5.php">Kişisel Bilgilerim</a></li>
              <li><a href="/final_projesi/hukukdosyalari.php">Hukuk Dosyaları</a></li>
              <li><a href="/final_projesi/icradosyalari.php">İcra Dosyaları</a></li>
              <li><a href="/final_projesi/durusmasorgulama.php">Duruşma Sorgulama</a></li>
              <li><a href="/final_projesi/makbuzgoruntuleme.php">Makbuz Görüntüleme</a></li>
            </ul>
            <p class="navbar-text navbar-right user-info">
                        
                    </p>
                    <div class="logout-button">
                        <button onclick="logout()">Oturumu Kapat</button>
                    </div>

          </div><!--/.nav-collapse -->
        </div>
      </nav>
      <!-- Menü sonu -->
    </body>

    </html>
  </div>
</body>

</html>
<script>
    // Oturumu kapat fonksiyonu
    function logout() {
        if (confirm('Oturumu kapatmak istediğinize emin misiniz?')) {
            window.location.href = "index2.php";
        }
    }
</script>
